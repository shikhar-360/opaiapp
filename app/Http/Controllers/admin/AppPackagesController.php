<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\PackagesModel;

class AppPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $packages = PackagesModel::where('app_id', $admin->app_id)->get();
        return view('admins.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan_code'  => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'roi_percent' => 'required|numeric|min:0',
        ]);

        $admin = Auth::guard('admin')->user();
        
        $validated['app_id'] = $admin->app_id;

        PackagesModel::create($validated);

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = PackagesModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = PackagesModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $package = PackagesModel::where('app_id', $admin->app_id)->findOrFail($id);

        $validated = $request->validate([
            'plan_code'  => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'roi_percent' => 'required|numeric|min:0',
        ]);

        $package->update($validated);

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = PackagesModel::where('app_id', $admin->app_id)->findOrFail($id);
        $package->delete();

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Package deleted successfully.');
    }
}
