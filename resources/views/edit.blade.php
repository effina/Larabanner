// resources/views/edit.blade.php
@extends('larabanner::layouts.app')

@section('larabanner-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Banner</div>

                <div class="card-body">
                    <form action="{{ route('larabanner.update', $banner) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('larabanner::_form')

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update Banner</button>
                            <a href="{{ route('larabanner.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

