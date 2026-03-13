@extends('layouts.dashboardLayout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card shadow-sm border-0 bg-white main-add-card" style="border-radius: 20px;">
                <div class="card-body p-5">

                    {{-- Form Header --}}
                    <div class="text-center mb-5">
                        <div class="icon-circle-header mx-auto mb-3"
                            style="width: 70px; height: 70px; background: rgba(31, 59, 179, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="mdi mdi-medical-bag text-primary" style="font-size: 30px;"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Add New Medical Service</h3>
                        <p class="text-muted small">Define a new medical service for your clinic department</p>
                    </div>

                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf

                        <div class="row">
                            {{-- Service Name --}}
                            <div class="col-md-7 mb-4">
                                <label class="form-label fw-bold">Service Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="mdi mdi-format-title text-primary"></i></span>
                                    <input type="text" name="name" class="form-control border-0 bg-light"
                                        placeholder="e.g. Dental Cleaning" required style="color: black;">
                                </div>
                            </div>

                            {{-- Subtitle --}}
                            <div class="col-md-5 mb-4">
                                <label class="form-label fw-bold">Subtitle / Short Note</label>
                                <input type="text" name="subtitle" class="form-control border-0 bg-light"
                                    placeholder="e.g. Includes X-Ray" style="color: black;">
                            </div>

                            {{-- Specialty Selection --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Specialty / Department</label>
                                <select name="specialty_id" class="form-select border-0 bg-light" required
                                    style="color: black;">
                                    <option value="" selected disabled>Choose Specialty...</option>
                                    @foreach ($specialities as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Image Upload --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Service Image (Optional)</label>
                                <input type="file" name="image" class="form-control border-0 bg-light" accept="image/*">
                            </div>

                            {{-- Price --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Service Price (EGP)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="mdi mdi-cash text-primary"></i></span>
                                    <input type="number" name="price" class="form-control border-0 bg-light"
                                        placeholder="0.00" required style="color: black;">
                                </div>
                            </div>

                            {{-- Duration --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Estimated Duration</label>
                                <select name="duration" class="form-select border-0 bg-light" style="color: black;">
                                    <option value="15">15 Minutes</option>
                                    <option value="30" selected>30 Minutes</option>
                                    <option value="45">45 Minutes</option>
                                    <option value="60">1 Hour</option>
                                </select>
                            </div>

                            {{-- Boolean: is_featured --}}
                            <div class="col-md-4 mb-4 d-flex align-items-center mt-3">
                                <div class="form-check form-switch" style="display: flex">
                                    <input class="form-check-input" type="checkbox" name="featured_service" id="isFeatured"
                                        value="1" style="margin-left: 50px;">
                                    <label class="form-check-label fw-bold ms-2" for="isFeatured"
                                        style="cursor: pointer; color: #1F3BB3;">
                                        Mark as Featured
                                    </label>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold">Service Description</label>
                                <textarea name="description" class="form-control border-0 bg-light" rows="3"
                                    placeholder="Describe the medical service..."></textarea>
                            </div>

                            {{-- JSON Array: featured_service (Features/Inclusions) --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold d-flex justify-content-between">
                                    Service Features & Inclusions (JSON)
                                    <button type="button" class="btn btn-sm btn-outline-primary border-0"
                                        onclick="addFeatureField()">
                                        <i class="mdi mdi-plus-circle"></i> Add Item
                                    </button>
                                </label>
                                <div id="features-container">
                                    <div class="input-group mb-2 feature-item">
                                        <input type="text" name="features[]" class="form-control border-0 bg-light"
                                            placeholder="e.g. Consultation included">
                                        <button class="btn btn-light text-danger border-0" type="button"
                                            onclick="removeFeatureField(this)">
                                            <i class="mdi mdi-close-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="text-muted">These items will be stored as a list of features for the
                                    service.</small>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3 shadow-sm">
                                <i class="mdi mdi-check-circle-outline me-2"></i>Save Service
                            </button>
                            <a href="{{ route('services.index') }}"
                                class="btn btn-light btn-lg rounded-pill px-5 border">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function addFeatureField() {
                const container = document.getElementById('features-container');
                const newField = document.createElement('div');
                newField.className = 'input-group mb-2 feature-item';
                newField.innerHTML = `
                                        <input type="text" name="features[]" class="form-control border-0 bg-light" placeholder="e.g. Consultation included">
                                        <button class="btn btn-light text-danger border-0" type="button" onclick="removeFeatureField(this)">
                                            <i class="mdi mdi-close-circle"></i>
                                        </button>
                                    `;
                container.appendChild(newField);
            }

            function removeFeatureField(button) {
                const container = document.getElementById('features-container');
                if (container.children.length > 1) {
                    button.closest('.feature-item').remove();
                } else {
                    button.closest('.feature-item').querySelector('input').value = '';
                }
            }
        </script>
    @endpush
@endsection