<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    public function index()
    {
        $jamaah = User::where('role', 'jamaah')->latest()->paginate(15);
        return view('admin.jamaah.index', compact('jamaah'));
    }

    public function create()
    {
        return view('admin.jamaah.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:100',
            'kondisi_ekonomi' => 'nullable|in:rendah,menengah,tinggi',
            'tanggungan' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'jamaah';
        User::create($data);

        return redirect()->route('admin.jamaah.index')->with('success', 'Data jamaah berhasil ditambahkan.');
    }

    public function show(User $jamaah)
    {
        $histories = $jamaah->assistanceHistories()->latest()->take(10)->get();
        return view('admin.jamaah.show', compact('jamaah', 'histories'));
    }

    public function edit(User $jamaah)
    {
        return view('admin.jamaah.edit', compact('jamaah'));
    }

    public function update(Request $request, User $jamaah)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $jamaah->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:100',
            'kondisi_ekonomi' => 'nullable|in:rendah,menengah,tinggi',
            'tanggungan' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $data['password'] = bcrypt($request->password);
        }

        $jamaah->update($data);
        return redirect()->route('admin.jamaah.index')->with('success', 'Data jamaah berhasil diupdate.');
    }

    public function destroy(User $jamaah)
    {
        $jamaah->delete();
        return redirect()->route('admin.jamaah.index')->with('success', 'Data jamaah berhasil dihapus.');
    }
}
