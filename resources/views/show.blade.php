// resources/views/show.blade.php
@extends('larabanner::layouts.app')

@section('larabanner-content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Banner Preview: {{ $banner->name }}</h2>
            <div>
                <a href="{{ route('larabanner.edit', $banner) }}" class="btn btn-primary">Edit Banner</a>
                <a href="{{ route('larabanner.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        Banner Details
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">
                                @if($banner->isDisplayable())
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </dd>

                            <dt class="col-sm-4">Display Days</dt>
                            <dd class="col-sm-8">
                                @if($banner->display_days)
                                    {{ implode(', ', array_map('ucfirst', $banner->display_days)) }}
                                @else
                                    All days
                                @endif
                            </dd>

                            <dt class="col-sm-4">Start Date</dt>
                            <dd class="col-sm-8">{{ $banner->display_start_date->format('Y-m-d H:i') }}</dd>

                            <dt class="col-sm-4">End Date</dt>
                            <dd class="col-sm-8">
                                {{ optional($banner->display_stop_date)->format('Y-m-d H:i') ?: 'No end date' }}
                            </dd>

                            <dt class="col-sm-4">Created</dt>
                            <dd class="col-sm-8">{{ $banner->created_at->format('Y-m-d H:i') }}</dd>

                            <dt class="col-sm-4">Updated</dt>
                            <dd class="col-sm-8">{{ $banner->updated_at->format('Y-m-d H:i') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"
                                   id="rendered-tab"
                                   data-bs-toggle="tab"
                                   href="#rendered"
                                   role="tab">Rendered Output</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   id="source-tab"
                                   data-bs-toggle="tab"
                                   href="#source"
                                   role="tab">Source Code</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="rendered" role="tabpanel">
                                <div class="border p-3 bg-white">
                                    {!! $banner->contents !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="source" role="tabpanel">
                                <pre class="border p-3 bg-light mb-0"><code>{{ $banner->contents }}</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
