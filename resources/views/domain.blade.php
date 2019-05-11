@extends('layouts/app')
@section('title', 'Domain')

@section('content')

<ul>
@forelse($domain as $value)
<li>{{ $value }}</li>
@empty
<li>No domains</li>
@endforelse
</ul>

@endsection