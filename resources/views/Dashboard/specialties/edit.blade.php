@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card mx-auto">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Edit : {{ $specialty->name }}</h4>
                        </div>
                    </div>

                    <form class="forms-sample" action="{{ route('specialties.update', $specialty->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="fw-bold small">Specialty Name</label>
                                <input type="text" name="name" value="{{ $specialty->name }}" class="form-control"
                                    placeholder="e.g. Cardiology" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="fw-bold small">Icon Class (MDI)</label>
                                <input type="text" name="icon" value="{{ $specialty->icon }}" class="form-control"
                                    placeholder="mdi-heart-pulse">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold small">Description</label>
                            <textarea name="description" class="form-control"  rows="4"
                                placeholder="Brief overview of the specialty...">{{ $specialty->description }}</textarea>
                        </div>

                        <div class="form-check form-check-flat form-check-primary mb-4">
                            <label class="form-check-label">
                                <input type="checkbox" name="is_active" {{ $specialty->is_active }} class="form-check-input"
                                    checked value="1">
                                Mark as Active Specialty
                                <i class="input-helper"></i></label>
                        </div>

                        <div class="mt-4 border-top pt-4 text-end">
                            <button type="button" class="btn btn-light me-2">Cancel</button>
                            <button type="submit" class="btn btn-primary text-white px-4">Edit Specialty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
