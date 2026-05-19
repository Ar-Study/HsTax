<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('jamaah.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:100',
            'kondisi_ekonomi' => 'nullable|in:rendah,menengah,tinggi',
            'tanggungan' => 'nullable|integer|min:0',
        ]);

        $user->update($data);
        return redirect()->route('jamaah.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update(['password' => bcrypt($request->password)]);
        return redirect()->route('jamaah.profile.edit')
            ->with('success', 'Password berhasil diubah.');
    }
}
