<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HstaxTestimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = HstaxTestimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'initial' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data['sort_order'] = HstaxTestimonial::max('sort_order') + 1;
        $data['is_approved'] = $request->boolean('is_active');

        HstaxTestimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(HstaxTestimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, HstaxTestimonial $testimonial)
    {
        $data = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'initial' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_approved'] = $request->boolean('is_active');

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(HstaxTestimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
