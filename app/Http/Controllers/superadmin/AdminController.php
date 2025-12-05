<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\AppsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    public function loginAs(UsersModel $admin)
    {
        if ($admin->role !== 'admin') abort(404);

        auth()->login($admin);

        return redirect()->route('admin.dashboard')
                            ->with('success', 'Logged in as admin.');
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
}
