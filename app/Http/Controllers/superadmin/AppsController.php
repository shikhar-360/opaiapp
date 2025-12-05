<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AppsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppsController extends Controller
{
    public function index()
    {
        $apps = AppsModel::latest()->paginate(10);
        return view('superadmin.apps.index', compact('apps'));
    }

    public function create()
    {
        return view('superadmin.apps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'primary_color' => 'nullable|string',
            'accent_color'  => 'nullable|string',
            'coin_price'    => 'required|numeric',
            'logo'          => 'nullable|image|max:2048',
        ]);

        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos', 'public');
        }

        AppsModel::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'primary_color' => $request->primary_color,
            'accent_color'  => $request->accent_color,
            'coin_price'    => $request->coin_price,
            'logo_path'     => $logo,
            'settings'      => json_encode([]),
        ]);

        return redirect()->route('superadmin.apps.index')->with('success', 'App created.');
    }

    public function edit(AppsModel $app)
    {
        return view('superadmin.apps.edit', compact('app'));
    }

    public function update(Request $request, AppsModel $app)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'primary_color' => 'nullable|string',
            'accent_color'  => 'nullable|string',
            'coin_price'    => 'required|numeric',
            'logo'          => 'nullable|image|max:2048',
        ]);

        $logo = $app->logo_path;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos', 'public');
        }

        $app->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'primary_color' => $request->primary_color,
            'accent_color'  => $request->accent_color,
            'coin_price'    => $request->coin_price,
            'logo_path'     => $logo,
        ]);

        return redirect()->route('superadmin.apps.index')->with('success', 'App updated.');
    }

    public function destroy(AppsModel $app)
    {
        $app->delete();
        return back()->with('success', 'App deleted.');
    }
}
