<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Program;
use App\Models\AssistanceApplication;
use App\Models\AssistanceDistribution;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function programReport(Request $request)
    {
        $query = Program::with('budgets');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->get();
        return view('admin.reports.program', compact('programs'));
    }

    public function donationReport(Request $request)
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

        $donations = $query->latest()->get();
        $total = $donations->sum('amount');
        
        return view('admin.reports.donation', compact('donations', 'total'));
    }

    public function assistanceReport(Request $request)
    {
        $query = AssistanceApplication::with('jamaah');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('application_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('application_date', '<=', $request->date_to);
        }

        $applications = $query->latest()->get();
        return view('admin.reports.assistance', compact('applications'));
    }

    public function financialReport()
    {
        $totalDonations = Donation::sum('amount');
        $totalDistributed = AssistanceDistribution::sum('amount');
        $balance = $totalDonations - $totalDistributed;

        $donationByType = Donation::selectRaw('type, SUM(amount) as total')
            ->groupBy('type')->pluck('total', 'type');

        $monthlyDonations = Donation::selectRaw('MONTH(donation_date) as month, SUM(amount) as total')
            ->whereYear('donation_date', date('Y'))
            ->groupBy('month')->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.reports.financial', compact(
            'totalDonations', 'totalDistributed', 'balance',
            'donationByType', 'monthlyDonations'
        ));
    }
}
