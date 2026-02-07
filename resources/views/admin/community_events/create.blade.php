@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Community Event</h2>
    <a href="{{ route('admin.community-events.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Back to Events
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.community-events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               required 
                               maxlength="255"
                               placeholder="e.g., Meet & Greet, Studio Tour, Charity Event">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="5" 
                                  required
                                  placeholder="Describe what this event is about...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text" class="form-label">Button Text</label>
                                <input type="text" 
                                       class="form-control @error('button_text') is-invalid @enderror" 
                                       id="button_text" 
                                       name="button_text" 
                                       value="{{ old('button_text', 'Learn More') }}" 
                                       maxlength="100">
                                @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_url" class="form-label">Button Link (URL)</label>
                                <input type="url" 
                                       class="form-control @error('button_url') is-invalid @enderror" 
                                       id="button_url" 
                                       name="button_url" 
                                       value="{{ old('button_url') }}" 
                                       maxlength="255"
                                       placeholder="https://example.com/event-details">
                                @error('button_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon (Font Awesome Class)</label>
                        <input type="text" 
                               class="form-control @error('icon') is-invalid @enderror" 
                               id="icon" 
                               name="icon" 
                               value="{{ old('icon', 'fas fa-calendar-check') }}" 
                               maxlength="100">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Examples: <code>fas fa-users</code>, <code>fas fa-broadcast-tower</code>, <code>fas fa-calendar-check</code>
                        </div>
                        <div class="mt-2 p-2 bg-light rounded text-center" id="icon-preview">
                            <i class="{{ old('icon', 'fas fa-calendar-check') }} fa-3x text-primary"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Event Image (Optional)</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/jpeg,image/png,image/jpg,image/gif">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Allowed formats: JPEG, PNG, JPG, GIF (Max: 2MB)
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="event_date" class="form-label">Event Date (Optional)</label>
                        <input type="date" 
                               class="form-control @error('event_date') is-invalid @enderror" 
                               id="event_date" 
                               name="event_date" 
                               value="{{ old('event_date') }}">
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="display_order" class="form-label">Display Order</label>
                        <input type="number" 
                               class="form-control @error('display_order') is-invalid @enderror" 
                               id="display_order" 
                               name="display_order" 
                               value="{{ old('display_order', 0) }}" 
                               min="0">
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lower numbers appear first.</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Visible on website)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.community-events.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Community Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Icon preview
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');
    
    iconInput.addEventListener('input', function() {
        iconPreview.innerHTML = '<i class="' + this.value + ' fa-3x text-primary"></i>';
    });
});
</script>
@endpush
