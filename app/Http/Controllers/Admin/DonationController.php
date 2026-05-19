<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with('jamaah');
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('donation_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('donation_date', '<=', $request->date_to);
        }

        $donations = $query->latest()->paginate(15);
        return view('admin.donations.index', compact('donations'));
    }

    public function create()
    {
        $jamaah = User::where('role', 'jamaah')->orderBy('name')->get();
        return view('admin.donations.create', compact('jamaah'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jamaah_id' => 'nullable|exists:users,id',
            'type' => 'required|in:donasi,infak,sedekah,sponsor',
            'amount' => 'required|numeric|min:0',
            'donation_date' => 'required|date',
            'payment_method' => 'required|in:cash,transfer,other',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        Donation::create($data);
        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dicatat.');
    }

    public function edit(Donation $donation)
    {
        $jamaah = User::where('role', 'jamaah')->orderBy('name')->get();
        return view('admin.donations.edit', compact('donation', 'jamaah'));
    }

    public function update(Request $request, Donation $donation)
    {
        $data = $request->validate([
            'jamaah_id' => 'nullable|exists:users,id',
            'type' => 'required|in:donasi,infak,sedekah,sponsor',
            'amount' => 'required|numeric|min:0',
            'donation_date' => 'required|date',
            'payment_method' => 'required|in:cash,transfer,other',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $donation->update($data);
        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil diupdate.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dihapus.');
    }
}
