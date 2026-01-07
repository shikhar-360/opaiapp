<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AppLeadershipChampionsIncomeModel;

class AppChampionsPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $packages = AppLeadershipChampionsIncomeModel::where('app_id', $admin->app_id)->get();
        return view('admins.championspackages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.championspackages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rank'  => 'required|string|min:3|max:255',
            'team_volume' => 'required|numeric|min:1',
            'points' => 'required|numeric|min:1',
            'directs' => 'required|numeric|min:1',
        ]);

        $admin = Auth::guard('admin')->user();
        
        $validated['app_id'] = $admin->app_id;

        AppLeadershipChampionsIncomeModel::create($validated);

        return redirect()->route('admin.championspackages.index')
                         ->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLeadershipChampionsIncomeModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.championspackages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLeadershipChampionsIncomeModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.championspackages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLeadershipChampionsIncomeModel::where('app_id', $admin->app_id)->findOrFail($id);

        $validated = $request->validate([
            'rank'  => 'required|string|min:3|max:255',
            'team_volume' => 'required|numeric|min:1',
            'points' => 'required|numeric|min:1',
            'directs' => 'required|numeric|min:1',
        ]);

        $package->update($validated);

        return redirect()->route('admin.championspackages.index')
                         ->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = AppLeadershipChampionsIncomeModel::where('app_id', $admin->app_id)->findOrFail($id);
        $package->delete();

        return redirect()->route('admin.championspackages.index')
                         ->with('success', 'Package deleted successfully.');
    }
}
