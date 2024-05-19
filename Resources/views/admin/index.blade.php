@extends('alvatrips::layouts.admin')

@section('title', 'Alva Trips')
@section('actions')
  <li>
    <a href="{{url('alvatrips/admin/create') }}">
      <i class="ti-plus"></i>
      Add New
    </a>
  </li>
@endsection
@section('content')
  <div class="card border-blue-bottom">
    <div class="header">
      <h4 class="title">
        Admin Scaffold!
      </h4>
    </div>
    <div class="content">
      <p>View generated from module: {{ config('alvatrips.name') }}</p>
    </div>
  </div>
@endsection
