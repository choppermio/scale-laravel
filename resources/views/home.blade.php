@extends('layouts.app')
@php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = auth()->id();
}
@endphp
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('لوحة الطالب') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
<div class="container my-4">
    <div class="row justify-content-center">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">اختبار Holland</h5>
            <p class="card-text">اكتشف المزيد حول اختبار هولاند لمعرفة ميولك المهنية.</p>
            <a href="{{ url('/disc-test') }}" class="btn btn-primary">ابدأ الاختبار</a>
          </div>
        </div>
      </div>
  
      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">اختبار DISC</h5>
            <p class="card-text">تعرف على نمط شخصيتك باستخدام اختبار DISC الشهير.</p>
            <a href="{{ url('scale/holland') }}" class="btn btn-primary">ابدأ الاختبار</a>
          </div>
        </div>
      </div>
  
      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">اختبار الذكاءات</h5>
            <p class="card-text">اكتشف أنواع الذكاءات التي تميزك من خلال هذا الاختبار.</p>
            <a href="{{ url('/thakaat-test') }}" class="btn btn-primary">ابدأ الاختبار</a>
          </div>
        </div>
      </div>
    </div>
  </div>






@php
$tests = \App\Models\ThakaatResults::where('user_id',   $user_id )->get();

@endphp
<div class="container my-4">
    <h2 class="text-center mb-4">نتيجة اختبار الذكاءات</h2>
    <ul class="list-group">
      @foreach($tests->groupBy('test_number') as $testNumber => $testGroup)
        <li class="list-group-item mb-3">
          <div class="d-flex justify-content-between align-items-center">
            <h5>رقم الاختبار: {{ $testNumber }}</h5>
            
          </div>
  
          <ul class="list-group mt-3">
            @foreach($testGroup as $test)
              <li class="list-group-item">
                <div class="d-flex justify-content-between" st>
                  <span>الفئة: {{ $test->category }}</span>
                  <span>الدرجة: {{ $test->score }}</span>
                  <span>النسبة: {{ $test->percentage }}%</span>
                </div>
              </li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>
  </div>



  <!--holland score-->
  <h2 class="text-center mb-4">نتيجة اختبار holland</h2>

                  @php
                $holland_scores = \App\Models\HollandPersona::where('user_id',   $user_id )->orderBy('id', 'desc')->first(); 
                         $holland_score=$holland_scores;     
                  @endphp
                  
<div class="container my-4">
    <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    رقم 1
                </div>
                <div class="card-body">
                    {{ $holland_score->first_type }}
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    رقم 2
                </div>
                <div class="card-body">
                    {{ $holland_score->second_type }}
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    رقم 3
                </div>
                <div class="card-body">
                    {{ $holland_score->third_type }}
                </div>
            </div>
        </div>
    </div>
  </div>




<!--disc results-->
<h2 class="text-center mb-4">نتيجة اختبار holland</h2>

<div class="row">
@php
$disc_results = \App\Models\DiscResult::where('user_id',   $user_id )->get();

// $disc_results = $disc_results->results;
@endphp
@foreach($disc_results as $disc_result)
    @foreach(json_decode($disc_result->results) as $index => $result)
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-header">
                    رقم : {{ $index + 1 }}
                </div>
                <div class="card-body">
                    {{ $result }}
                </div>
            </div>
        </div>
    @endforeach
@endforeach
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
