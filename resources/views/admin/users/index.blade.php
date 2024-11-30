@extends('layouts.admin')

@section('content')
<div class="container">
@php
$users = App\Models\User::all();
@endphp
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>رقم المستخدم</th>
          <th>اسم المستخدم</th>
          <th>البريد الإلكتروني</th>
          <th>نتائج الإختبارات</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="{{ url('home/?user_id=' . $user->id) }}">عرض النتائج</a></td>

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endsection
