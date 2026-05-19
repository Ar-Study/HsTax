<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssistanceApplication;
use App\Models\AssistanceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistanceApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AssistanceApplication::with('jamaah');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type')) {
            $query->where('assistance_type', $request->type);
        }

        $applications = $query->latest()->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function show(AssistanceApplication $application)
    {
        $application->load('jamaah', 'verifier', 'distributions');
        return view('admin.applications.show', compact('application'));
    }

    public function verify(Request $request, AssistanceApplication $application)
    {
        $data = $request->validate([
            'status' => 'required|in:approved,rejected,postponed',
            'amount_approved' => 'nullable|numeric|min:0',
            'admin_note' => 'nullable|string',
        ]);

        $data['verified_by'] = Auth::id();
        $data['verification_date'] = now();

        if ($data['status'] === 'rejected' || $data['status'] === 'postponed') {
            $data['amount_approved'] = null;
        }

        $application->update($data);

        AssistanceHistory::updateOrCreate(
            ['application_id' => $application->id],
            [
                'jamaah_id' => $application->jamaah_id,
                'assistance_type' => $application->assistance_type,
                'amount' => $data['amount_approved'] ?? $application->amount_requested,
                'date' => now(),
                'status' => $data['status'],
            ]
        );

        return redirect()->route('admin.applications.index')
            ->with('success', 'Status pengajuan bantuan berhasil diperbarui.');
    }
}
