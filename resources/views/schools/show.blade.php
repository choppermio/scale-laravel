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
                            <p><strong>اسم المدرسة:</strong> {{ $school->name }}</p>
                            <p><strong>العنوان:</strong> {{ $school->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>رقم الهاتف:</strong> {{ $school->phone }}</p>
                            <p><strong>المجموعة:</strong> {{ $school->schoolGroup->name ?? 'غير محدد' }}</p>
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
                                <th>نتائج هولاند</th>
                                <th>نتائج الذكاءات</th>
                                <th>نتائج ديسك</th>
                                {{-- <th>الدور</th> --}}
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $users = \App\Models\User::where('school_id',$school->id)->paginate(10);
                            @endphp
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    @php
    $hollandPersona = \App\Models\HollandPersona::where('user_id', $user->id)->first();
@endphp
@if ($hollandPersona)
{{ $hollandPersona->first_type }}: {{ $hollandPersona->first_score }},
{{ $hollandPersona->second_type }}: {{ $hollandPersona->second_score }},
{{ $hollandPersona->third_type }}: {{ $hollandPersona->third_score }}
@else
No data
@endif
                                </td>
                               
                                    <td>
                                        @php
                                            $thakaatResults = \App\Models\ThakaatResult::where('user_id', $user->id)->get();
                                        @endphp
                                        @foreach ($thakaatResults as $result)
                                            {{ $result->category }}: {{ $result->score }} ({{ $result->percentage }}%)<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $discResults = \App\Models\DiscResult::where('user_id', $user->id)->first();
                                            $discData = $discResults ? json_decode($discResults->results, true) : [];
                                        @endphp
                                        @if ($discData)
                                            @foreach ($discData as $key => $value)
                                             {{ $value}} , 
                                            @endforeach
                                        @else
                                            No data
                                        @endif
                                    </td>
                                
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>{{ $user->role ?? 'مستخدم' }}</td> --}}
                                {{-- <td>{{ $user->created_at->format('Y-m-d') }}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('schools.index') }}" class="btn btn-secondary">رجوع</a>
            </div>
        </div>
    </div>
</div>
@endsection