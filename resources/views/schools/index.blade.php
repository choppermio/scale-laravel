<!-- resources/views/schools/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>المدارس</h2>
                    <a href="{{ route('schools.create') }}" class="btn btn-primary">إضافة مدرسة جديدة</a>
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
                                <th>الاسم</th>
                                <th>العنوان</th>
                                <th>الهاتف</th>
                                <th>المجموعة</th>
                          
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                            <tr>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->address }}</td>
                                <td>{{ $school->phone }}</td>
                                <td>{{ $school->schoolGroup->name ?? 'غير محدد' }}</td>
                                
                                <td>
                                    <a href="{{ route('schools.show', $school) }}" class="btn btn-sm btn-info">عرض</a>
                                    <a href="{{ route('schools.edit', $school) }}" class="btn btn-sm btn-primary">تعديل</a>
                                    <form action="{{ route('schools.destroy', $school) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="display: none;" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $schools->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection