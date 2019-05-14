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
            <th scope="col">H1</th>
            <th scope="col">Keywords</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->response_code }}</td>
            <td>{{ $domain->response_content_length }}</td>
            <td>{{ $domain->h1 }}</td>
            <td>{{ $domain->meta_keywords }}</td>
            <td>{{ $domain->meta_description }}</td>
        </tr>
    </tbody>
</table>

@endsection