<?php

namespace App\Providers;

use App\Models\HstaxPackage;
use App\Models\HstaxTestimonial;
use App\Models\HstaxFaq;
use App\Models\HstaxSetting;
use Illuminate\Support\ServiceProvider;

class HstaxServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            $settings = HstaxSetting::all()->pluck('value', 'key')->toArray();
            $packages = HstaxPackage::orderBy('sort_order')->get()->toArray();
            $testimonials = HstaxTestimonial::where('is_approved', true)->orderBy('sort_order')->get()->toArray();
            $faqs = HstaxFaq::orderBy('sort_order')->get()->toArray();

            $dbConfig = [];

            foreach ($settings as $key => $value) {
                $decoded = json_decode($value, true);
                $dbConfig[$key] = $decoded !== null ? $decoded : $value;
            }

            $packages = array_map(function ($pkg) {
                $pkg['popular'] = $pkg['is_popular'] ?? false;
                unset($pkg['is_popular'], $pkg['id'], $pkg['created_at'], $pkg['updated_at'], $pkg['sort_order']);
                $pkg['features'] = is_string($pkg['features']) ? json_decode($pkg['features'], true) : ($pkg['features'] ?? []);
                return $pkg;
            }, $packages);

            $faqs = array_map(function ($faq) {
                return ['q' => $faq['question'], 'a' => $faq['answer']];
            }, $faqs);

            $testimonials = array_map(function ($t) {
                unset($t['id'], $t['created_at'], $t['updated_at'], $t['sort_order'], $t['is_approved']);
                return $t;
            }, $testimonials);

            $dbConfig['packages'] = $packages;
            $dbConfig['testimonials'] = $testimonials;
            $dbConfig['faqs'] = $faqs;

            $hstax = config('hstax', []);
            foreach ($dbConfig as $key => $value) {
                if (!empty($value) || $value !== null) {
                    $hstax[$key] = $value;
                }
            }

            config(['hstax' => $hstax]);
        } catch (\Exception $e) {
            // Tables may not exist yet (migrations not run)
        }
    }
}
