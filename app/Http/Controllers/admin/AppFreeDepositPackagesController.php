<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\FreeDepositPackagesModel;
use App\Models\PackagesModel;
use App\Models\CustomersModel;

class AppFreeDepositPackagesController extends Controller
{
    public function index()
    {
        // $records = FreeDepositPackagesModel::latest()->paginate(20);
        $admin = Auth::guard('admin')->user();
        $records = FreeDepositPackagesModel::where('app_id', $admin->app_id)
                                        ->with(['app', 'package', 'customer'])
                                        ->latest()
                                        ->paginate(20);

        return view('admins.freedepositpackages.index', compact('records'));
    }

    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $packages = PackagesModel::where('app_id', $admin->app_id)->pluck('plan_code', 'id');
        $customers = CustomersModel::where('app_id', $admin->app_id)->pluck('name', 'id');
        return view('admins.freedepositpackages.create', compact('packages', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id'  => 'required|numeric',
            'customer_id' => 'required|numeric',
            'status'      => 'required|numeric|in:0,1',
        ]);
        $admin = Auth::guard('admin')->user();
        $validated['app_id'] = $admin->app_id;

        FreeDepositPackagesModel::create($validated);

        return redirect()->route('admin.freedepositpackages.index')
            ->with('success', 'Record created successfully');
    }

    public function edit(FreeDepositPackagesModel $freedepositpackage)
    {
        $admin = Auth::guard('admin')->user();
        $packages = PackagesModel::where('app_id', $admin->app_id)->pluck('plan_code', 'id');
        $customers = CustomersModel::where('app_id', $admin->app_id)->pluck('name', 'id');
        return view('admins.freedepositpackages.edit', compact('freedepositpackage', 'packages', 'customers'));
    }

    public function update(Request $request, FreeDepositPackagesModel $freedepositpackage)
    {
        $validated = $request->validate([
            'package_id'  => 'required|numeric',
            'customer_id' => 'required|numeric',
            'status'      => 'required|numeric|in:0,1',
        ]);

        $admin = Auth::guard('admin')->user();
        $validated['app_id'] = $admin->app_id;

        $freedepositpackage->update($validated);

        return redirect()->route('admin.freedepositpackages.index')
            ->with('success', 'Record updated successfully');
    }

    public function destroy(FreeDepositPackagesModel $freedepositpackage)
    {
        $freedepositpackage->delete();

        return redirect()->route('admin.freedepositpackages.index')
            ->with('success', 'Record deleted successfully');
    }
}
