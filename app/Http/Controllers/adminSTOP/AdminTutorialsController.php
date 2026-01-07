<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; 

use App\Models\AdminTutorialsModel;

class AdminTutorialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $tutorials = AdminTutorialsModel::latest()->paginate(10);
        return view('admins.tutorials.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        return view('admins.tutorials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        AdminTutorialsModel::create([
            'app_id'        => auth()->user()->app_id ?? 1,
            'resource_type' => $request->resource_type ?? 'video',
            'title'         => $request->title,
            'sub_title'     => $request->sub_title,
            'url'           => $request->url,
            'created_by'    => auth()->id(),
        ]);

        return redirect()->route('admin.tutorials.index')
            ->with('success', 'Tutorial added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Auth::guard('admin')->user();
        $tutorial = AdminTutorialsModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.tutorials.edit', compact('tutorial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Auth::guard('admin')->user();
        $tutorial = AdminTutorialsModel::where('app_id', $admin->app_id)->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        $tutorial->update($validated);

        return redirect()->route('admin.tutorials.index')
            ->with('success', 'Tutorial updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Auth::guard('admin')->user();
        $tutorial = AdminTutorialsModel::where('app_id', $admin->app_id)->findOrFail($id);
        $tutorial->delete();

        return back()->with('success', 'Tutorial deleted');
    }
}
