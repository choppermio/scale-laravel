<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroup;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class SchoolGroupController extends Controller
{
    public function index()
    {
        $SchoolGroups = SchoolGroup::with(['school', 'responsibleUser'])->paginate(10);
        return view('admin.schoolgroups.index', compact('SchoolGroups'));
    }
    
    public function create()
    {
        $schools = School::all();
        $users = User::all();
        return view('admin.schoolgroups.create', compact('schools', 'users'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            // 'school_id' => 'required|exists:schools,id',
            'responsible_user_id' => 'required|exists:users,id',
        ]);
    
        SchoolGroup::create($validated);
    
        return redirect()->route('admin.schoolgroups.index')
            ->with('success', 'تم إنشاء القسم بنجاح');
    }
    
    public function edit(SchoolGroup $schoolgroup)
    {
        $schools = School::all();
        $users = User::all();
        $section = SchoolGroup::find($schoolgroup->id);
        return view('admin.schoolgroups.edit', compact('schoolgroup', 'schools', 'users','section'));
    }
    
    public function update(Request $request, SchoolGroup $schoolgroup)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            // 'school_id' => 'required|exists:schools,id',
            'responsible_user_id' => 'required|exists:users,id',
        ]);
    
        $schoolgroup->update($validated);
    
        return redirect()->route('admin.schoolgroups.index')
            ->with('success', 'تم تحديث القسم بنجاح');
    }
    
    public function destroy(SchoolGroup $schoolgroup)
    {
        // dd($schoolgroup);
        $schoolgroup->delete();
        return redirect()->route('admin.schoolgroups.index')
            ->with('success', 'تم حذف القسم بنجاح');
    }
}
