@extends('layouts/app')
@section('title', 'Domain')

@section('content')
<p></p>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Domain</th>
            <th scope="col">Response code</th>
            <th scope="col">Content length</th>
        </tr>
    </thead>
    <tbody>
        @forelse($domains as $domain)
        <tr>
            <td><a href="domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
            <td>{{ $domain->response_code }}</td>
            <td>{{ $domain->response_content_length }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="text-center">No domains</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $domains->links() }}

@endsection