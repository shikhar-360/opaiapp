<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\AppsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // List Admins
    public function index()
    {
        $admins = UsersModel::where('role', 'admin')
                ->with('app')
                ->latest()
                ->paginate(15);

        return view('superadmin.admins.index', compact('admins'));
    }

    // Create Form
    public function create()
    {
        $apps = AppsModel::all();
        return view('superadmin.admins.create', compact('apps'));
    }

    // Store Admin
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:users',
            'app_id' => 'required|exists:apps,id',
            'password' => 'required|min:3|max:20',
        ]);

        $password = Str::random(8);

        UsersModel::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
            'app_id'   => $request->app_id,
        ]);

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', "Admin created successfully.");
    }

    // Edit Admin
    public function edit(UsersModel $admin)
    {
        if ($admin->role !== 'admin') abort(404);

        $apps = AppsModel::all();

        return view('superadmin.admins.edit', compact('admin', 'apps'));
    }

    // Update Admin
    public function update(Request $request, UsersModel $admin)
    {
        if ($admin->role !== 'admin') abort(404);

         $rules = [
            'name'   => 'required',
            'email'  => 'required|email|unique:users,email,' . $admin->id,
            'app_id' => 'required|exists:apps,id',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:3|max:20'; 
        }

        $request->validate($rules);

        $data = $request->only(['name', 'email', 'app_id']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        
        $admin->update($data);

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', "Admin updated.");
    }

    // Delete Admin
    public function destroy(UsersModel $admin)
    {
        if ($admin->role !== 'admin') abort(404);

        $admin->delete();

        return back()->with('success', "Admin deleted.");
    }

    // Login As Admin
   /* public function loginAs(UsersModel $admin)
    {
        if ($admin->role !== 'admin') abort(404);

        auth()->login($admin);

        return redirect()->route('admin.dashboard')
                            ->with('success', 'Logged in as admin.');
    }*/

    public function loginAsAdmin(UsersModel $adminUser)
    {
        // dd($adminUser->id, $adminUser->role, $adminUser->getAttributes());

        if ($adminUser->role !== 'admin') abort(404);

        $current = Auth::guard('superadmin')->user(); // adjust if your superadmin guard name differs
        if (!$current) abort(403);

        // push current identity into stack

        $stack = Session::get('impersonation_stack', []);
        $last = end($stack);
        if (!$last || $last['guard'] !== 'superadmin' || $last['id'] !== $current->id) {
            $stack[] = ['guard' => 'superadmin', 'id' => $current->id];
            session(['impersonation_stack' => $stack]);
        }

        // $last = end($stack);
        // $stack[] = ['guard' => 'superadmin', 'id' => $current->id];
        // Session::put('impersonation_stack', $stack);

        // logout superadmin guard, login admin guard
        Auth::guard('superadmin')->logout();
        Auth::guard('admin')->login($adminUser);

        request()->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Logged in as admin.');
    }

    public function dashboard()
    {
        return view('admins.dashboard');
    }


    public function logout()
    {
        Auth::logout();

        // Invalidate the session to remove all session data
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page (or wherever you want them to go)
        return redirect('admin.login');
    }

    public function returnToSuperadmin(Request $request)
    {
        $stack = session('impersonation_stack', []);

        if (empty($stack)) {
            return redirect()->route('admin.login')
                ->withErrors(['error' => 'No impersonation session found.']);
        }

        // Must currently be admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->withErrors(['error' => 'You are not logged in as admin.']);
        }

        // Last stack entry MUST be superadmin
        $prev = end($stack);
        if (!$prev || $prev['guard'] !== 'superadmin') {
            return redirect()->route('admin.dashboard')
                ->withErrors(['error' => 'Return path to superadmin not found.']);
        }

        // 1) Logout admin HARD (clear guard session keys too)
        Auth::guard('admin')->logout();
        $request->session()->forget(Auth::guard('admin')->getName());         // login_admin_xxx
        $request->session()->forget(Auth::guard('admin')->getRecallerName()); // remember_admin_xxx

        // 2) Pop superadmin from stack
        $superEntry = array_pop($stack);
        session(['impersonation_stack' => $stack]);

        // 3) Login superadmin back
        $super = UsersModel::findOrFail($superEntry['id']);
        Auth::guard('superadmin')->login($super);

        // Force session to contain superadmin id (extra safety like returnToAdmin)
        $request->session()->put(Auth::guard('superadmin')->getName(), $super->getAuthIdentifier());

        // Clear intended redirect so it won't bounce weirdly
        $request->session()->forget('url.intended');

        // Rotate session id safely
        $request->session()->migrate(true);

        return redirect()->route('superadmin.dashboard')->with('success', 'Returned to superadmin.');
    }

}
