<!-- resources/views/sections/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-right">الأقسام</h2>
                    <a href="{{ route('admin.schoolgroups.create') }}" class="btn btn-primary float-left">إضافة قسم جديد</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الاسم</th>
                                <th>المسؤول</th>
                                <th>عدد الطلاب</th>
                                <th>رابط تسجيل الطلاب</th>

                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($SchoolGroups as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->responsibleUser->name ??'لايوجد'}}</td>
                                <td>

@php
           $schoolGroups = \App\Models\School::where('school_group_id', $section->id)->get();
        //    dd($schoolGroups);
    $sumuser = 0;
    foreach ($schoolGroups as $schoolGroup) {
        $students = \App\Models\User::where('school_id', $schoolGroup->id)->get();
        $sumuser += $students->count();
    }

@endphp

{{ $sumuser }}
                                </td>
                                <td>https://sc.qimam-community.com/register?id={{ $section->id }}</td>
                                <td>
                                    <a href="{{ route('admin.schoolgroups.show', $section) }}" class="btn btn-sm btn-info">عرض</a>
                                    <a href="{{ route('admin.schoolgroups.edit', $section) }}" class="btn btn-sm btn-primary">تعديل</a>
                                    <form action="{{ route('admin.schoolgroups.destroy', $section) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="display: none;" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $SchoolGroups->links() }}

                    <h2>مجموع الطلاب: 

                        
@php
$schoolGroups = \App\Models\School::all();
//    dd($schoolGroups);
$sumuser = 0;
foreach ($schoolGroups as $schoolGroup) {
$students = \App\Models\User::where('school_id', $schoolGroup->id)->get();
$sumuser += $students->count();
}

@endphp

{{ $sumuser }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection