<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" 
           class="form-control @error('name') is-invalid @enderror" 
           id="name" 
           name="name" 
           value="{{ old('name', $banner->name ?? '') }}" 
           required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="contents" class="form-label">Contents</label>
    <textarea class="form-control @error('contents') is-invalid @enderror" 
              id="contents" 
              name="contents" 
              rows="5" 
              required>{{ old('contents', $banner->contents ?? '') }}</textarea>
    @error('contents')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">HTML content is allowed.</div>
</div>

<div class="mb-3">
    <label class="form-label">Display Days</label>
    <div class="row">
        @foreach(['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day)
            <div class="col-auto">
                <div class="form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="day_{{ $day }}"
                           name="display_days[]" 
                           value="{{ $day }}"
                           {{ in_array($day, old('display_days', $banner->display_days ?? [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="day_{{ $day }}">
                        {{ ucfirst($day) }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    @error('display_days')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    <div class="form-text">Leave all unchecked to display on all days.</div>
</div>

<div class="mb-3">
    <label for="display_start_date" class="form-label">Start Date</label>
    <input type="datetime-local" 
           class="form-control @error('display_start_date') is-invalid @enderror" 
           id="display_start_date" 
           name="display_start_date" 
           value="{{ old('display_start_date', isset($banner) ? $banner->display_start_date->format('Y-m-d\TH:i') : '') }}"
           required>
    @error('display_start_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="display_stop_date" class="form-label">End Date</label>
    <input type="datetime-local" 
           class="form-control @error('display_stop_date') is-invalid @enderror" 
           id="display_stop_date" 
           name="display_stop_date" 
           value="{{ old('display_stop_date', isset($banner) && $banner->display_stop_date ? $banner->display_stop_date->format('Y-m-d\TH:i') : '') }}">
    @error('display_stop_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">Leave empty for no end date.</div>
</div>

