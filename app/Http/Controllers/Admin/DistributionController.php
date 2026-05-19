<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssistanceApplication;
use App\Models\AssistanceDistribution;
use App\Models\AssistanceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionController extends Controller
{
    public function index(Request $request)
    {
        $query = AssistanceDistribution::with('application.jamaah', 'distributedBy');

        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }

        $distributions = $query->latest()->paginate(15);
        return view('admin.distributions.index', compact('distributions'));
    }

    public function create()
    {
        $applications = AssistanceApplication::with('jamaah')
            ->where('status', 'approved')
            ->whereDoesntHave('distributions')
            ->latest()
            ->get();

        return view('admin.distributions.create', compact('applications'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'application_id' => 'required|exists:assistance_applications,id',
            'amount' => 'required|numeric|min:0',
            'distribution_date' => 'required|date',
            'method' => 'required|in:cash,transfer,goods,other',
            'notes' => 'nullable|string',
        ]);

        $data['distributed_by'] = Auth::id();
        $distribution = AssistanceDistribution::create($data);

        $application = $distribution->application;
        AssistanceHistory::updateOrCreate(
            ['application_id' => $application->id],
            [
                'jamaah_id' => $application->jamaah_id,
                'assistance_type' => $application->assistance_type,
                'amount' => $data['amount'],
                'date' => $data['distribution_date'],
                'status' => 'distributed',
            ]
        );

        return redirect()->route('admin.distributions.index')
            ->with('success', 'Distribusi bantuan berhasil dicatat.');
    }

    public function show(AssistanceDistribution $distribution)
    {
        $distribution->load('application.jamaah', 'distributedBy');
        return view('admin.distributions.show', compact('distribution'));
    }
}
