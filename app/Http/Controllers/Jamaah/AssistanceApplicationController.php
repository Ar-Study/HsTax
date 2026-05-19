<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\AssistanceApplication;
use App\Models\AssistanceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistanceApplicationController extends Controller
{
    public function index()
    {
        $applications = AssistanceApplication::where('jamaah_id', Auth::id())
            ->latest()->paginate(15);
        return view('jamaah.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('jamaah.applications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'assistance_type' => 'required|string|max:100',
            'amount_requested' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $data['jamaah_id'] = Auth::id();
        $data['application_date'] = now();
        $data['status'] = 'pending';

        $application = AssistanceApplication::create($data);

        AssistanceHistory::create([
            'jamaah_id' => Auth::id(),
            'application_id' => $application->id,
            'assistance_type' => $data['assistance_type'],
            'amount' => $data['amount_requested'],
            'date' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('jamaah.applications.index')
            ->with('success', 'Pengajuan bantuan berhasil dikirim.');
    }

    public function show(AssistanceApplication $application)
    {
        if ($application->jamaah_id !== Auth::id()) {
            abort(403);
        }
        $application->load('distributions');
        return view('jamaah.applications.show', compact('application'));
    }
}
