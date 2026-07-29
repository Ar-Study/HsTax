<?php

namespace App\Http\Controllers;

use App\Models\HstaxSetting;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // Load settings from DB with config fallback
        $dbSettings = HstaxSetting::pluck('value', 'key');

        $company = [
            'name' => $dbSettings['company.name'] ?? config('hstax.company.name'),
            'tagline' => $dbSettings['company.tagline'] ?? config('hstax.company.tagline'),
            'short' => $dbSettings['company.short'] ?? config('hstax.company.short'),
            'description' => $dbSettings['company.description'] ?? config('hstax.company.description'),
            'hero_badge' => $dbSettings['company.hero_badge'] ?? config('hstax.company.hero_badge'),
            'hero_title' => $dbSettings['company.hero_title'] ?? config('hstax.company.hero_title'),
            'hero_sub' => $dbSettings['company.hero_sub'] ?? config('hstax.company.hero_sub'),
            'copyright' => $dbSettings['company.copyright'] ?? config('hstax.company.copyright'),
        ];

        $logo = $dbSettings['logo'] ?? config('hstax.logo');

        $contact = [
            'email' => $dbSettings['contact.email'] ?? config('hstax.contact.email'),
            'phone' => $dbSettings['contact.phone'] ?? config('hstax.contact.phone'),
            'phone_formatted' => $dbSettings['contact.phone_formatted'] ?? config('hstax.contact.phone_formatted'),
            'address' => $dbSettings['contact.address'] ?? config('hstax.contact.address'),
            'address_short' => $dbSettings['contact.address_short'] ?? config('hstax.contact.address_short'),
            'maps_url' => $dbSettings['contact.maps_url'] ?? config('hstax.contact.maps_url'),
            'maps_q' => $dbSettings['contact.maps_q'] ?? config('hstax.contact.maps_q'),
            'working_hours' => $dbSettings['contact.working_hours'] ?? config('hstax.contact.working_hours'),
        ];

        $whatsapp = [
            'number' => $dbSettings['whatsapp.number'] ?? config('hstax.whatsapp.number'),
            'text' => $dbSettings['whatsapp.text'] ?? config('hstax.whatsapp.text'),
        ];

        $socialSetting = HstaxSetting::where('key', 'social')->first();
        $social = $socialSetting ? json_decode($socialSetting->value, true) : config('hstax.social');

        // Stats
        $stats = config('hstax.stats');
        $steps = config('hstax.steps');
        $why = config('hstax.why');
        $packages = \App\Models\HstaxPackage::orderBy('sort_order')->get();
        $testimonials = \App\Models\HstaxTestimonial::where('is_approved', true)->orderBy('sort_order')->get();
        $faqs = \App\Models\HstaxFaq::orderBy('sort_order')->get();
        $documents = config('hstax.documents');
        $audience = config('hstax.audience');
        $trust = config('hstax.trust');
        $payments = config('hstax.payments');

        // News
        $news = News::published()->latest()->take(3)->get();

        return view('hstax.index', compact(
            'company', 'logo', 'contact', 'whatsapp', 'social',
            'stats', 'steps', 'why', 'packages', 'testimonials',
            'faqs', 'documents', 'audience', 'trust', 'payments', 'news'
        ));
    }

    public function showNews($slug)
    {
        $news = News::where('slug', $slug)->published()->firstOrFail();
        $recentNews = News::where('id', '!=', $news->id)->published()->latest()->take(4)->get();
        $comments = Comment::where('news_id', $news->id)->approved()->latest()->get();

        return view('hstax.news-detail', compact('news', 'recentNews', 'comments'));
    }

    public function storeComment(Request $request, $newsId)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'content' => 'required|string|max:2000',
        ]);

        $data['news_id'] = $newsId;
        $data['is_approved'] = false;

        Comment::create($data);

        return back()->with('comment_success', 'Komentar berhasil dikirim dan menunggu persetujuan.');
    }
}
