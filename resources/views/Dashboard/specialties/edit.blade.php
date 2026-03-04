@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card mx-auto">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Edit Specialty: {{ $specialty->name }}</h4>
                            <p class="card-subtitle card-subtitle-dash">Update the department details for the clinic</p>
                        </div>
                    </div>

                    <form class="forms-sample" action="{{ route('specialties.update', $specialty->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Specialty Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name', $specialty->name) }}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Slug (URL)</label>
                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                    value="{{ old('slug', $specialty->slug) }}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" 
                                    value="{{ old('subtitle', $specialty->subtitle) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Icon Class (MDI)</label>
                                <input type="text" name="icon" class="form-control" 
                                    value="{{ old('icon', $specialty->icon) }}">
                            </div>

                            <div class="form-group col-md-8">
                                <label class="fw-bold small">Cover Image</label>
                                @if($specialty->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $specialty->image) }}" alt="current image" style="height: 50px; border-radius: 4px;">
                                        <small class="text-muted ms-2">Current Image</small>
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="fw-bold small">Procedures Count</label>
                                <input type="number" name="procedures_count" class="form-control" 
                                    value="{{ old('procedures_count', $specialty->procedures_count) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="fw-bold small">Procedures Label</label>
                                <input type="text" name="procedures_label" class="form-control" 
                                    value="{{ old('procedures_label', $specialty->procedures_label) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold small">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $specialty->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold small d-block">Specialty Features</label>
                            <div id="features-container">
                                @php
                                    $features = old('features', is_array($specialty->features) ? $specialty->features : json_decode($specialty->features, true) ?? []);
                                @endphp

                                @forelse($features as $feature)
                                    <div class="input-group mb-2">
                                        <input type="text" name="features[]" class="form-control" value="{{ $feature['title'] }}">
                                        <button type="button" class="btn btn-outline-danger btn-icon remove-feature"><i class="mdi mdi-close"></i></button>
                                    </div>
                                @empty
                                    <div class="input-group mb-2">
                                        <input type="text" name="features[]" class="form-control" placeholder="Feature e.g. Free Consultation">
                                        <button type="button" class="btn btn-outline-danger btn-icon remove-feature"><i class="mdi mdi-close"></i></button>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-feature" class="btn btn-outline-primary btn-sm mt-1">
                                <i class="mdi mdi-plus"></i> Add Feature
                            </button>
                        </div>

                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $specialty->is_active ? 'checked' : '' }}>
                                Mark as Active
                                <i class="input-helper"></i>
                            </label>
                        </div>

                        <div class="mt-4 border-top pt-4 text-end">
                            <a href="{{ route('specialties.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary text-white px-4">Update Specialty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-Slug generation (only if user clears it or wants to change it)
        document.getElementById('name').addEventListener('input', function() {
            let slug = this.value.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
            document.getElementById('slug').value = slug;
        });

        // Add Feature Row
        document.getElementById('add-feature').addEventListener('click', function() {
            const container = document.getElementById('features-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="text" name="features[]" class="form-control" placeholder="Feature">
                <button type="button" class="btn btn-outline-danger btn-icon remove-feature"><i class="mdi mdi-close"></i></button>
            `;
            container.appendChild(div);
        });

        // Remove Feature Row
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-feature')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection