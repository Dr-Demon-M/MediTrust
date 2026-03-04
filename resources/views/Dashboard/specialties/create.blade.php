@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card mx-auto">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Add New Specialty</h4>
                            <p class="card-subtitle card-subtitle-dash">Configure a new clinic department and its public features</p>
                        </div>
                    </div>

                    <form class="forms-sample" action="{{ route('specialties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Specialty Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Dental Care" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Slug (URL)</label>
                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="dental-care" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="Advanced oral health services">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="fw-bold small">Icon Class (MDI)</label>
                                <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="mdi-account-star">
                            </div>

                            <div class="form-group col-md-8">
                                <label class="fw-bold small">Cover Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="fw-bold small">Procedures Count</label>
                                <input type="number" name="procedures_count" class="form-control" value="{{ old('procedures_count', 0) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="fw-bold small">Procedures Label</label>
                                <input type="text" name="procedures_label" class="form-control" value="{{ old('procedures_label') }}" placeholder="e.g. Successful Surgeries">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold small">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold small d-block">Specialty Features</label>
                            <div id="features-container">
                                <div class="input-group mb-2">
                                    <input type="text" name="features[]" class="form-control" placeholder="Feature e.g. Free Consultation">
                                    <button type="button" class="btn btn-outline-danger btn-icon remove-feature"><i class="mdi mdi-close"></i></button>
                                </div>
                            </div>
                            <button type="button" id="add-feature" class="btn btn-outline-primary btn-sm mt-1">
                                <i class="mdi mdi-plus"></i> Add Feature
                            </button>
                        </div>

                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" class="form-check-input" checked value="1">
                                Mark as Active
                            <i class="input-helper"></i></label>
                        </div>

                        <div class="mt-4 border-top pt-4 text-end">
                            <a href="{{ route('specialties.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary text-white px-4">Save Specialty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-Slug generation
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