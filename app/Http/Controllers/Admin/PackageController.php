<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HstaxPackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = HstaxPackage::orderBy('sort_order')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|string|max:100',
            'period' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
        ]);

        $data['features'] = $data['features'] ? array_map('trim', explode("\n", $data['features'])) : [];
        $data['sort_order'] = HstaxPackage::max('sort_order') + 1;
        $data['is_popular'] = $request->has('is_popular');

        HstaxPackage::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(HstaxPackage $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, HstaxPackage $package)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|string|max:100',
            'period' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data['features'] = $data['features'] ? array_map('trim', explode("\n", $data['features'])) : [];
        $data['is_popular'] = $request->has('is_popular');

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(HstaxPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }
}
