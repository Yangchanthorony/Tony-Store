<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\employeeRequest;
use App\Models\employee;

class employeeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $employees = employee::orderBy('section')->get();
        $employees = employee::latest()->paginate(10);
        // Define list of employee options (could come from a model, config, etc.)
        $availableEmployees = [];
        return view('employees.index', compact('employees', 'availableEmployees'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('employees.create');
    }

    public function store(employeeRequest $request): \Illuminate\Http\RedirectResponse
    {
        employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Created successfully');
    }

    public function show(employee $employee): \Illuminate\Contracts\View\View
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(employee $employee): \Illuminate\Contracts\View\View
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(employeeRequest $request, employee $employee): \Illuminate\Http\RedirectResponse
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'Updated successfully');
    }

    public function destroy(employee $employee): \Illuminate\Http\RedirectResponse
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Deleted successfully');
    }
}
