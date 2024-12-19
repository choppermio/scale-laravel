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
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <!-- <th>البريد الإلكتروني</th> -->
                                <th>نتائج هولاند</th>
                                <th>نتائج الذكاءات</th>
                                <th>نتائج ديسك</th>
                                {{-- <th>الدور</th> --}}
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $users = \App\Models\User::where('school_id',$school->id)->get();
                            @endphp
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <!-- <td>{{ $user->email }}</td> -->

                                <td>
                                    @php
    $hollandPersona = \App\Models\HollandPersona::where('user_id', $user->id)->first();
@endphp
@if ($hollandPersona)
    @php
        $typeTranslations = [
            'R' => 'واقعي',
            'I' => 'استقصائي',
            'A' => 'فني',
            'S' => 'اجتماعي',
            'E' => 'مغامر',
            'C' => 'تقليدي'
        ];

        $firstType = $typeTranslations[$hollandPersona->first_type] ?? $hollandPersona->first_type;
        $secondType = $typeTranslations[$hollandPersona->second_type] ?? $hollandPersona->second_type;
        $thirdType = $typeTranslations[$hollandPersona->third_type] ?? $hollandPersona->third_type;
    @endphp

    {{ $firstType }}: {{ $hollandPersona->first_score }}<br />
    {{ $secondType }}: {{ $hollandPersona->second_score }}<br />
    {{ $thirdType }}: {{ $hollandPersona->third_score }}
@else
No data
@endif
                                </td>
                               
                                    <td>
                                        @php
                                            $thakaatResults = \App\Models\ThakaatResult::where('user_id', $user->id)->get();
                                        @endphp
                                       @php
                                       $intelligenceTypes = [
                                           'L' => 'الذكاء اللغوي',
                                           'M' => 'الذكاء المنطقي الرياضي',
                                           'V' => 'الذكاء البصري',
                                           'B' => 'الذكاء البيولوجي',
                                           'N' => 'الذكاء الطبيعي',
                                           'I' => 'الذكاء المكاني',
                                           'U' => 'الذكاء الموسيقي',
                                           'P' => 'الذكاء الشخصي'
                                       ];
                                   @endphp
                                   
                                   @foreach ($thakaatResults as $result)
                                       {{ $intelligenceTypes[$result->category] ?? $result->category }}: {{ $result->score }} ({{ $result->percentage }}%)<br>
                                   @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $discResults = \App\Models\DiscResult::where('user_id', $user->id)->first();
                                            $discData = $discResults ? json_decode($discResults->results, true) : [];
                                        @endphp
                                        @if ($discData)
                                            @foreach ($discData as $key => $value)
                                             {{ $value}} 
                                            @endforeach
                                        @else
                                            No data
                                        @endif
                                    </td>
                                
                                
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
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- Include DataTables JS -->
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Include DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
        });
    </script>
        </div>
    </div>
</div>
@endsection