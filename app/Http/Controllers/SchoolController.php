<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolGroup;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::with('schoolGroup')->paginate(10);
        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        $schoolGroups = SchoolGroup::all();
        return view('schools.create', compact('schoolGroups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required',
            'school_group_id' => 'required|exists:school_groups,id',
        ]);

        School::create($validated);

        return redirect()->route('schools.index')
            ->with('success', 'تم إضافة المدرسة بنجاح');
    }

    public function show(School $school)
    {

    // $users = $school->users->paginate(10);
    
    
    return view('schools.show', compact('school'));
    }

    public function edit(School $school)
    {
        $schoolGroups = SchoolGroup::all();
        return view('schools.edit', compact('school', 'schoolGroups'));
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required',
            'school_group_id' => 'required|exists:school_groups,id',
        ]);

        $school->update($validated);

        return redirect()->route('schools.index')
            ->with('success', 'تم تحديث المدرسة بنجاح');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')
            ->with('success', 'تم حذف المدرسة بنجاح');
    }
}