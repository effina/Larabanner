@extends('larabanner::layouts.app')

@section('larabanner-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Banners</h2>
    <a href="{{ route('larabanner.create') }}" class="btn btn-primary">Create New Banner</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Days</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td>{{ $banner->name }}</td>
                            <td>
                                @if($banner->display_days)
                                    {{ implode(', ', array_map('ucfirst', $banner->display_days)) }}
                                @else
                                    All days
                                @endif
                            </td>
                            <td>{{ $banner->display_start_date->format('Y-m-d H:i') }}</td>
                            <td>{{ optional($banner->display_stop_date)->format('Y-m-d H:i') ?: 'No end date' }}</td>
                            <td>
                                @if($banner->isDisplayable())
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('larabanner.show', $banner) }}"
                                       class="btn btn-sm btn-secondary">Preview</a>
                                    <a href="{{ route('larabanner.edit', $banner) }}"
                                       class="btn btn-sm btn-info text-white">Edit</a>
                                    <form action="{{ route('larabanner.destroy', $banner) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No banners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $banners->links() }}
@endsection

