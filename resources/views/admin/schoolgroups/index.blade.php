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
                                <th>المدرسة</th>
                                <th>المسؤول</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SchoolGroups as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->school->name ??'' }}</td>
                                <td>{{ $section->responsibleUser->name }}</td>
                                <td>
                                    <a href="{{ route('admin.schoolgroups.edit', $section) }}" class="btn btn-sm btn-primary">تعديل</a>
                                    <form action="{{ route('admin.schoolgroups.destroy', $section) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $SchoolGroups->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection