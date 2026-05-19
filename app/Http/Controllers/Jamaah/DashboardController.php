<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\AssistanceApplication;
use App\Models\AssistanceHistory;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'total_applications' => AssistanceApplication::where('jamaah_id', $user->id)->count(),
            'pending_applications' => AssistanceApplication::where('jamaah_id', $user->id)->where('status', 'pending')->count(),
            'approved_applications' => AssistanceApplication::where('jamaah_id', $user->id)->where('status', 'approved')->count(),
            'total_donations' => Donation::where('jamaah_id', $user->id)->sum('amount'),
            'histories' => AssistanceHistory::where('jamaah_id', $user->id)->latest()->take(5)->get(),
            'applications' => AssistanceApplication::where('jamaah_id', $user->id)->latest()->take(5)->get(),
        ];

        return view('jamaah.dashboard', $data);
    }
}
