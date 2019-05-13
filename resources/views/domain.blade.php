@extends('layouts/app')
@section('title', 'Domain')

@section('content')

<p></p>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Domain</th>
            <th scope="col">Response code</th>
            <th scope="col">Content length</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->response_code }}</td>
            <td>{{ $domain->response_content_length }}</td>
        </tr>
    </tbody>
</table>

@endsection