<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $apps = AppsModel::where('id', $admin->app_id)->paginate(10);
        return view('admins.app.index', compact('apps'));
    }

    // public function create()
    // {
    //     return view('superadmin.apps.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'          => 'required|string|max:255',
    //         'primary_color' => 'nullable|string',
    //         'accent_color'  => 'nullable|string',
    //         'coin_price'    => 'required|numeric',
    //         'logo'          => 'nullable|image|max:2048',
    //     ]);

    //     $logo = null;
    //     if ($request->hasFile('logo')) {
    //         $logo = $request->file('logo')->store('logos', 'public');
    //     }

    //     AppsModel::create([
    //         'name'          => $request->name,
    //         'slug'          => Str::slug($request->name),
    //         'primary_color' => $request->primary_color,
    //         'accent_color'  => $request->accent_color,
    //         'coin_price'    => $request->coin_price,
    //         'logo_path'     => $logo,
    //         'settings'      => json_encode([]),
    //     ]);

    //     return redirect()->route('superadmin.apps.index')->with('success', 'App created.');
    // }

    public function edit(AppsModel $adminapp)
    {
        $admin = Auth::guard('admin')->user();
        return view('admins.app.edit', compact('adminapp'));
    }

    public function update(Request $request, AppsModel $adminapp)
    {
        $request->validate([
            'name'                  =>  'required|string|max:255',
            'primary_color'         =>  'nullable|string',
            'accent_color'          =>  'nullable|string',
            'coin_price'            =>  'required|numeric',
            'logo'                  =>  'nullable|image|max:2048',
            'currency'              =>  'required|string|min:2|max:100',
            'admin_withdraw_fee'    =>  'required|numeric',
            'cappingx'              =>  'required|numeric|min:1',
        ]);

        $logo = $adminapp->logo_path;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos', 'public');
        }

        $adminapp->update([
            'name'              =>  $request->name,
            'slug'              =>  Str::slug($request->name),
            'primary_color'     =>  $request->primary_color,
            'accent_color'      =>  $request->accent_color,
            'coin_price'        =>  $request->coin_price,
            'logo_path'         =>  $logo,
            'currency'          =>  $request->currency,
            'admin_withdraw_fee'=>  $request->admin_withdraw_fee,
            'cappingx'          =>  $request->cappingx
        ]);

        return redirect()->route('admin.adminapp.index')->with('success', 'App updated.');
    }

    // public function destroy(AppsModel $app)
    // {
    //     $app->delete();
    //     return back()->with('success', 'App deleted.');
    // }
}
