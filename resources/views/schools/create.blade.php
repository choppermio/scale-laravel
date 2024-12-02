<!-- resources/views/schools/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">إضافة مدرسة جديدة</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('schools.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">اسم المدرسة</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">الهاتف</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="school_group_id">المجموعة</label>
                            <select class="form-control @error('school_group_id') is-invalid @enderror" id="school_group_id" name="school_group_id" required>
                                <option value="">اختر المجموعة</option>
                                @foreach($schoolGroups as $group)
                                    <option value="{{ $group->id }}" {{ old('school_group_id') == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('school_group_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{ route('schools.index') }}" class="btn btn-secondary">رجوع</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection