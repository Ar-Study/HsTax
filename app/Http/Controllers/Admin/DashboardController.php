<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Program;
use App\Models\AssistanceApplication;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_jamaah' => User::where('role', 'jamaah')->count(),
            'total_donations' => Donation::sum('amount'),
            'donation_count' => Donation::count(),
            'pending_applications' => AssistanceApplication::where('status', 'pending')->count(),
            'approved_applications' => AssistanceApplication::where('status', 'approved')->count(),
            'active_programs' => Program::where('status', 'active')->count(),
            'recent_donations' => Donation::with('jamaah')->latest()->take(5)->get(),
            'recent_applications' => AssistanceApplication::with('jamaah')->latest()->take(5)->get(),
            'monthly_donations' => Donation::selectRaw('MONTH(donation_date) as month, SUM(amount) as total')
                ->whereYear('donation_date', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month'),
        ];

        return view('admin.dashboard', $data);
    }
}
