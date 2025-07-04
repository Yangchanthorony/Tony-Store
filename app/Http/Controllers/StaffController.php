<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\staffRequest;
use App\Models\employee;
use App\Models\staff;
use Illuminate\Support\Facades\Storage;

class staffController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        
        $staff = Staff::with('section')->latest()->paginate(10);

        return view('staff.index', compact('staff'));
    }

public function create(): \Illuminate\Contracts\View\View
{
    $employees = Employee::orderBy('id')->get(); // Correct model
    return view('staff.create', compact('employees'));
}

public function store(StaffRequest $request): \Illuminate\Http\RedirectResponse
{
    $imagePath = $request->file('image')->store('staff', 'public'); // image must match input name

    Staff::create([
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'phone' => $request->phone,
        'address' => $request->address,
        'image' => $imagePath,
        'section_id' => $request->section_id,
        
    ]);

    // Update qty in employee (not staff!)
    $employee = employee::find($request->section_id);
    if ($employee) {
        $employee->increment('qty');
    }

    return redirect()->route('staff.index')->with('success', 'Created successfully');
}


    public function show(staff $staff): \Illuminate\Contracts\View\View
    {
        return view('staff.show', compact('staff'));
    }

    public function edit(staff $staff): \Illuminate\Contracts\View\View
    {

         $employees = Employee::orderBy('id')->get(); // Pass employees for dropdown
    return view('staff.edit', compact('staff', 'employees'));
    }

    public function update(staffRequest $request, staff $staff): \Illuminate\Http\RedirectResponse
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:staff,email,' . $staff->id,
        'gender' => 'nullable|string|max:20',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ Corrected rule
        'section_id' => ['required', 'exists:employees,id'],
    ]);
    

    $imagePath = $staff->image;

    if ($request->hasFile('image')) {
        // Delete old image
        if ($staff->image && Storage::disk('public')->exists($staff->image)) {
            Storage::disk('public')->delete($staff->image);
        }

        // Save new image
        $imagePath = $request->file('image')->store('staff', 'public');
    }

    $staff->update([
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'phone' => $request->phone,
        'address' => $request->address,
        'image' => $imagePath,
        'section_id' => $request->section_id,
        
    ]);
        return redirect()->route('staff.index')->with('success', 'Updated successfully');
    }

    public function destroy(Staff $staff): \Illuminate\Http\RedirectResponse
{
     // Get the associated employee (section) using the foreign key
    $employee = Employee::find($staff->section_id);

    // Delete the staff image from storage if it exists
    if ($staff->image && Storage::disk('public')->exists($staff->image)) {
        Storage::disk('public')->delete($staff->image);
    }

    // Delete the staff
    $staff->delete();

    // Decrement employee qty if exists and greater than 0
    if ($employee && $employee->qty > 0) {
        $employee->decrement('qty');
    }

    return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
}

}
