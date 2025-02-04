@extends('larabanner::layouts.app')

@section('larabanner-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Banner</div>

                <div class="card-body">
                    <form action="{{ route('larabanner.store') }}" method="POST">
                        @csrf
                        @include('larabanner::_form')

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Create Banner</button>
                            <a href="{{ route('larabanner.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

