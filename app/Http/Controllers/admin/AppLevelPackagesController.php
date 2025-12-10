<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AppLevelPackagesModel;

class AppLevelPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $packages = AppLevelPackagesModel::where('app_id', $admin->app_id)->get();
        return view('admins.levelpackages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.levelpackages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'level'  => 'required|string|max:255',
            'directs' => 'required|numeric|min:0',
            'reward' => 'required|numeric|min:0',
        ]);

        $admin = Auth::guard('admin')->user();
        
        $validated['app_id'] = $admin->app_id;

        AppLevelPackagesModel::create($validated);

        return redirect()->route('admin.levelpackages.index')
                         ->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLevelPackagesModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.levelpackages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLevelPackagesModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.levelpackages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLevelPackagesModel::where('app_id', $admin->app_id)->findOrFail($id);

        $validated = $request->validate([
            'level'  => 'required|string|max:255',
            'directs' => 'required|numeric|min:0',
            'reward' => 'required|numeric|min:0',
        ]);

        $package->update($validated);

        return redirect()->route('admin.levelpackages.index')
                         ->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLevelPackagesModel::where('app_id', $admin->app_id)->findOrFail($id);
        $package->delete();

        return redirect()->route('admin.levelpackages.index')
                         ->with('success', 'Package deleted successfully.');
    }
}
