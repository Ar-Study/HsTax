<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Comment;
use App\Models\HstaxPackage;
use App\Models\HstaxTestimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_news' => News::count(),
            'published_news' => News::where('is_published', true)->count(),
            'total_packages' => HstaxPackage::count(),
            'active_packages' => HstaxPackage::count(),
            'total_testimonials' => HstaxTestimonial::count(),
            'approved_testimonials' => HstaxTestimonial::where('is_approved', true)->count(),
            'total_comments' => Comment::count(),
            'pending_comments' => Comment::where('is_approved', false)->count(),
            'recent_news' => News::latest()->take(5)->get(),
            'recent_comments' => Comment::with('news')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
