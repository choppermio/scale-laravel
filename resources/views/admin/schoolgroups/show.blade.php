<!-- resources/views/schools/show.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>معلومات المدرسة</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>اسم المجموعة:</strong> {{ $schoolgroup->name }}</p>
                            <p><strong>اسم المسؤول:</strong> {{ $schoolgroup->responsibleUser->name }}</p>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>المستخدمون في المدرسة</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>عدد الطلاب</th>
                                <th>الطلاب</th>
                            </tr>
                        </thead>
                        <tbody>
                           {{-- @dd($schoolgroup->school) --}}
                            @foreach ($schoolgroup->school as $school)
                            <tr>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->address }}</td>
                                {{-- <td>{{ $school->mobile ?? 'لايوجد' }}</td> --}}
                                <td>

                                    @php
           $schools = \App\Models\School::where('id', $school->id)->get();
        //    dd($schools);
    $sumuser = 0;
    foreach ($schools as $school) {
        $students = \App\Models\User::where('school_id', $school->id)->get();
        $sumuser += $students->count();
    }

@endphp

{{ $sumuser }}
                                </td>
                                <td><a href="{{ route('schools.show', $school->id) }}" class="btn btn-sm btn-info">عرض</a></td>
                                {{-- <td>{{ $user->role ?? 'مستخدم' }}</td> --}}
                                {{-- <td>{{ $user->created_at->format('Y-m-d') }}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $schoolgroup->links() }} --}}
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('schools.index') }}" class="btn btn-secondary">رجوع</a>
            </div>
        </div>
    </div>
</div>
@endsection