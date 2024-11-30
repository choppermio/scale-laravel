<!-- resources/views/sections/edit.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تعديل القسم</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.schoolgroups.update', $section) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">اسم القسم</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $section->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="school_id">المدرسة</label>
                            <select class="form-control d-none @error('school_id') is-invalid @enderror" id="school_id" name="school_id" >
                                <option value="">اختر المدرسة</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" {{ old('school_id', $section->school_id) == $school->id ? 'selected' : '' }}>
                                        {{ $school->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('school_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="responsible_user_id">المسؤول</label>
                            <select class="form-control @error('responsible_user_id') is-invalid @enderror" id="responsible_user_id" name="responsible_user_id" required>
                                <option value="">اختر المسؤول</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('responsible_user_id', $section->responsible_user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('responsible_user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">تحديث</button>
                        <a href="{{ route('admin.schoolgroups.index') }}" class="btn btn-secondary">رجوع</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection