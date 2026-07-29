<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HstaxFaq;
use App\Models\HstaxPackage;
use App\Models\HstaxSetting;
use App\Models\HstaxTestimonial;
use Illuminate\Http\Request;

class HstaxController extends Controller
{
    public function index()
    {
        return view('admin.hstax.index');
    }

    public function company()
    {
        return view('admin.hstax.company');
    }

    public function updateCompany(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_tagline' => 'required|string|max:255',
            'company_short' => 'required|string|max:50',
            'company_description' => 'required|string|max:255',
            'company_hero_badge' => 'required|string|max:255',
            'company_hero_title' => 'required|string',
            'company_hero_sub' => 'required|string',
            'company_copyright' => 'required|string',
            'logo' => 'nullable|string|max:255',
        ]);

        $map = [
            'company_name' => 'company.name',
            'company_tagline' => 'company.tagline',
            'company_short' => 'company.short',
            'company_description' => 'company.description',
            'company_hero_badge' => 'company.hero_badge',
            'company_hero_title' => 'company.hero_title',
            'company_hero_sub' => 'company.hero_sub',
            'company_copyright' => 'company.copyright',
            'logo' => 'logo',
        ];

        foreach ($map as $field => $key) {
            HstaxSetting::updateOrCreate(['key' => $key], ['value' => $data[$field], 'group' => 'company']);
        }

        return redirect()->route('admin.cms.company')->with('success', 'Informasi perusahaan berhasil diperbarui.');
    }

    public function contact()
    {
        return view('admin.hstax.contact');
    }

    public function updateContact(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'phone_formatted' => 'required|string|max:50',
            'address' => 'required|string',
            'address_short' => 'required|string',
            'maps_url' => 'nullable|string',
            'maps_q' => 'nullable|string',
            'working_hours' => 'required|string',
            'wa_number' => 'required|string',
            'wa_text' => 'nullable|string',
        ]);

        $map = [
            'email' => 'contact.email',
            'phone' => 'contact.phone',
            'phone_formatted' => 'contact.phone_formatted',
            'address' => 'contact.address',
            'address_short' => 'contact.address_short',
            'maps_url' => 'contact.maps_url',
            'maps_q' => 'contact.maps_q',
            'working_hours' => 'contact.working_hours',
            'wa_number' => 'whatsapp.number',
            'wa_text' => 'whatsapp.text',
        ];

        foreach ($map as $field => $key) {
            HstaxSetting::updateOrCreate(['key' => $key], ['value' => $data[$field], 'group' => 'contact']);
        }

        return redirect()->route('admin.cms.contact')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function social()
    {
        $socialSetting = HstaxSetting::where('key', 'social')->first();
        $socialData = $socialSetting ? json_decode($socialSetting->value, true) : config('hstax.social');

        return view('admin.hstax.social', [
            'instagramUrl' => $socialData['instagram']['url'] ?? config('hstax.social.instagram.url'),
            'instagramHandle' => $socialData['instagram']['handle'] ?? config('hstax.social.instagram.handle'),
            'tiktokUrl' => $socialData['tiktok']['url'] ?? config('hstax.social.tiktok.url'),
            'tiktokHandle' => $socialData['tiktok']['handle'] ?? config('hstax.social.tiktok.handle'),
        ]);
    }

    public function updateSocial(Request $request)
    {
        $data = $request->validate([
            'instagram_url' => 'nullable|string',
            'instagram_handle' => 'nullable|string|max:100',
            'tiktok_url' => 'nullable|string',
            'tiktok_handle' => 'nullable|string|max:100',
        ]);

        $social = [
            'instagram' => ['url' => $data['instagram_url'], 'handle' => $data['instagram_handle']],
            'tiktok' => ['url' => $data['tiktok_url'], 'handle' => $data['tiktok_handle']],
        ];

        HstaxSetting::updateOrCreate(['key' => 'social'], ['value' => json_encode($social), 'group' => 'social']);

        return redirect()->route('admin.cms.social')->with('success', 'Sosial media berhasil diperbarui.');
    }

    public function packages()
    {
        $packages = HstaxPackage::orderBy('sort_order')->get();
        return view('admin.hstax.packages', compact('packages'));
    }

    public function storePackage(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|string|max:100',
            'period' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
        ]);

        $data['features'] = $data['features'] ? array_map('trim', explode("\n", $data['features'])) : [];
        $data['sort_order'] = HstaxPackage::max('sort_order') + 1;
        $data['is_popular'] = $request->has('is_popular');

        HstaxPackage::create($data);

        return redirect()->route('admin.hstax.packages')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function editPackage(HstaxPackage $package)
    {
        return view('admin.hstax.package-edit', compact('package'));
    }

    public function updatePackage(Request $request, HstaxPackage $package)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|string|max:100',
            'period' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data['features'] = $data['features'] ? array_map('trim', explode("\n", $data['features'])) : [];
        $data['is_popular'] = $request->has('is_popular');

        $package->update($data);

        return redirect()->route('admin.hstax.packages')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroyPackage(HstaxPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.hstax.packages')->with('success', 'Paket berhasil dihapus.');
    }

    public function testimonials()
    {
        $testimonials = HstaxTestimonial::orderBy('sort_order')->get();
        return view('admin.hstax.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $data = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'initial' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'is_approved' => 'nullable|boolean',
        ]);

        $data['sort_order'] = HstaxTestimonial::max('sort_order') + 1;
        $data['is_approved'] = $request->has('is_approved');

        HstaxTestimonial::create($data);

        return redirect()->route('admin.hstax.testimonials')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function editTestimonial(HstaxTestimonial $testimonial)
    {
        return view('admin.hstax.testimonial-edit', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, HstaxTestimonial $testimonial)
    {
        $data = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'initial' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'is_approved' => 'nullable|boolean',
        ]);

        $data['is_approved'] = $request->has('is_approved');

        $testimonial->update($data);

        return redirect()->route('admin.hstax.testimonials')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroyTestimonial(HstaxTestimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.hstax.testimonials')->with('success', 'Testimoni berhasil dihapus.');
    }

    public function faqs()
    {
        $faqs = HstaxFaq::orderBy('sort_order')->get();
        return view('admin.hstax.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
        ]);

        $data['sort_order'] = HstaxFaq::max('sort_order') + 1;

        HstaxFaq::create($data);

        return redirect()->route('admin.hstax.faqs')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function editFaq(HstaxFaq $faq)
    {
        return view('admin.hstax.faq-edit', compact('faq'));
    }

    public function updateFaq(Request $request, HstaxFaq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
        ]);

        $faq->update($data);

        return redirect()->route('admin.hstax.faqs')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroyFaq(HstaxFaq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.hstax.faqs')->with('success', 'FAQ berhasil dihapus.');
    }

    public function services()
    {
        return view('admin.hstax.services');
    }

    public function updateServices(Request $request)
    {
        $steps = $request->validate([
            'steps' => 'required|array',
            'steps.*.num' => 'required|integer',
            'steps.*.title' => 'required|string',
            'steps.*.desc' => 'required|string',
        ]);

        HstaxSetting::updateOrCreate(
            ['key' => 'steps'],
            ['value' => json_encode($steps['steps']), 'group' => 'services']
        );

        return redirect()->route('admin.cms.services')->with('success', 'Layanan berhasil diperbarui.');
    }
}
