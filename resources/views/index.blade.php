@extends('layouts/app')
@section('title', 'Home')

@section('content')
<p></p>
@isset($error)
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endisset
<div class="jumbotron">
    <form method="POST" action="{{ route('addDomain') }}">
        <div class="form-group">
            <h2>Page SEO analyzer</h2>
            <label for="url">Website URL</label>
            <input type="url" class="form-control" name="url" id="url" aria-describedby="urlHelp" placeholder="Enter url">
            <small id="urlHelp" class="form-text text-muted">example: https://google.com</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection