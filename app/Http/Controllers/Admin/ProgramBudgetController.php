<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramBudget;
use Illuminate\Http\Request;

class ProgramBudgetController extends Controller
{
    public function index(Program $program)
    {
        $budgets = $program->budgets()->latest()->get();
        return view('admin.programs.budgets.index', compact('program', 'budgets'));
    }

    public function create(Program $program)
    {
        return view('admin.programs.budgets.create', compact('program'));
    }

    public function store(Request $request, Program $program)
    {
        $data = $request->validate([
            'item_name' => 'required|string|max:200',
            'estimated_cost' => 'required|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,realized',
        ]);

        $program->budgets()->create($data);
        return redirect()->route('admin.programs.budgets.index', $program)
            ->with('success', 'Item anggaran berhasil ditambahkan.');
    }

    public function edit(Program $program, ProgramBudget $budget)
    {
        return view('admin.programs.budgets.edit', compact('program', 'budget'));
    }

    public function update(Request $request, Program $program, ProgramBudget $budget)
    {
        $data = $request->validate([
            'item_name' => 'required|string|max:200',
            'estimated_cost' => 'required|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,realized',
        ]);

        $budget->update($data);
        return redirect()->route('admin.programs.budgets.index', $program)
            ->with('success', 'Item anggaran berhasil diupdate.');
    }

    public function destroy(Program $program, ProgramBudget $budget)
    {
        $budget->delete();
        return redirect()->route('admin.programs.budgets.index', $program)
            ->with('success', 'Item anggaran berhasil dihapus.');
    }
}
