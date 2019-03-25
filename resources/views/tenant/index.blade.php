@extends('layouts.app')

@section('toolbar')
@parent
<li class="nav-item">
    <a class="nav-link" href="{{ url('/tenant/ticket') }}">Tickets</a>
</li>
@endsection
