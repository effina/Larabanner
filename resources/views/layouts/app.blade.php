@extends(config('larabanner.layout') ?: 'larabanner::layouts.default')

@section(config('larabanner.sections.title', 'title'))
Banner Management
@endsection

@section(config('larabanner.sections.styles', 'styles'))
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section(config('larabanner.sections.content', 'content'))
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@yield('larabanner-content')
@endsection

@section(config('larabanner.sections.scripts', 'scripts'))
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
