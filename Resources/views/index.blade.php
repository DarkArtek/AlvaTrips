@extends('alvatrips::layouts.frontend')
@section('title', 'AlvaTrips')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div style="float:right">
        <a href="{{ route('alvatrips.create') }}" class="btn btn-outline-info pull-right btn-lg"
           style="margin-top: -10px; margin-bottom: 5px">
          Create new Trip
        </a>
      </div>
      <h2>My Trips</h2>
      @include('flash::message')
      @include('alvatrips::trips_table')
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      {{-- {{ $trips->links('pagination.default') }} --}}
    </div>
  </div>
@endsection
