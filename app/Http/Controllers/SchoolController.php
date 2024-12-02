<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolGroup;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::with('schoolGroup')->paginate(150);
        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        $schoolGroups = SchoolGroup::all();
        return view('schools.create', compact('schoolGroups'));
    }

    public function storeing(){
        $jsonData = '{
            "names": [
                "ث76",
                "مدرسة 72 الثانوية بحي الفضيله",
                "مدارس الحمراء",
                "مدرسة 102 الثانوية بحي الفضيله",
                "مدرسة الثانوية ١١٩.حكومي",
                "الثانويه ١١٧",
                "مدارس القلم",
                "الفيصلية",
                "ثانوية 40",
                "الثانوية 38",
                "مدرسة 93 الثانوية بحي الحرازات",
                "الثانويه 105",
                "ثانوية ٣٧",
                "ثانوية 45"
            ]
        }';
        
        $data = json_decode($jsonData, true);
        
        foreach ($data['names'] as $name) {
            School::create([
                'name' => $name,
                'address' => 'Default Address', // Replace with actual address if available
                'phone' => '0000000000', // Replace with actual phone number if available
                'school_group_id' => 10
            ]);
        }
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