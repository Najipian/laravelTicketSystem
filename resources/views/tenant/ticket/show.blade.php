@extends('tenant.index')

@section('content')
<div class="container">
    @include('common.ticket.new_comment' , ['routePrefix' => 'tenant'])
    @include('common.ticket.show' , ['routePrefix' => 'tenant'])
</div>

@endsection
