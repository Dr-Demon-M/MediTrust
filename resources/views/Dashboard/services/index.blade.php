@extends('layouts.dashboardLayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/clinic-services.css') }}?v={{ time() }}">

    <div class="row">
        <div class="col-12 grid-margin stretch-card m-1">
            <div class="card shadow-sm border-0 bg-white" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-5 px-2 mt-2">
                        <div>
                            <h4 class="fw-bold mb-1 text-dark">Medical Services Directory</h4>
                            <p class="text-muted small mb-0">Manage and view all clinic departments and medical services</p>
                        </div>
                        @can('create', App\Models\Service::class)
                            <a href="{{ route('services.create') }}"
                                class="btn btn-primary d-flex align-items-center text-white px-4 py-2"
                                style="border-radius: 10px; font-weight: 600;">
                                <i class="mdi mdi-plus-circle-outline me-2"></i> Add New Service
                            </a>
                        @endcan
                    </div>

                    <div class="row px-2">
                        @foreach ($specialities as $specialty)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="inner-service-box p-3 d-flex flex-column h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="category-icon-small text-primary"
                                            style="background-color: rgba(230, 230, 230, 0.451)">
                                            <i class="mdi {{ $specialty->icon }}"></i>
                                        </div>
                                        <h4 class="fw-bold mb-0 ms-3 text-dark">{{ $specialty->name }}</h4>
                                    </div>

                                    <ul class="list-unstyled mb-0">
                                        @forelse ($specialty->services as $service)
                                            <li
                                                class="d-flex align-items-center py-2 border-bottom-light service-item-container">
                                                <div class="service-item-clickable d-flex align-items-center flex-grow-1"
                                                    data-bs-toggle="modal" data-bs-target="#serviceDetailModal"
                                                    data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                                    data-subtitle="{{ $service->subtitle }}"
                                                    data-specialty="{{ $specialty->name }}"
                                                    data-description="{{ $service->description ?? 'No description available.' }}"
                                                    data-price="{{ $service->price ?? '0' }}"
                                                    data-duration="{{ $service->duration ?? '--' }}"
                                                    data-featured="{{ $service->featured_service }}"
                                                    data-image="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                                                    data-features='@json($service->features ?? [])' style="cursor: pointer;">
                                                    <i
                                                        class="mdi mdi-check-circle-outline text-success me-2 small-icon"></i>
                                                    <span class="text-primary fw-medium large">{{ $service->name }}</span>
                                                </div>

                                                <div class="quick-actions-container d-flex align-items-center ms-2">
                                                    <button class="btn btn-link text-primary p-0 me-2 quick-edit-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editServiceModal"
                                                        data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                                        data-subtitle="{{ $service->subtitle }}"
                                                        data-description="{{ $service->description }}"
                                                        data-price="{{ $service->price }}"
                                                        data-duration="{{ $service->duration }}"
                                                        data-featured="{{ $service->featured_service }}">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </button>
                                                    @can('delete', $service)
                                                        <button class="btn btn-link text-danger p-0 quick-delete-btn"
                                                            onclick="confirmDeleteService('{{ $service->id }}', '{{ $service->name }}')">
                                                            <i class="mdi mdi-delete-outline"></i>
                                                        </button>
                                                    @endcan
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-muted small py-3">No services in this department.</li>
                                        @endforelse
                                    </ul>
                                    @can('view', $specialty)
                                        <div class="mt-auto pt-4 text-center">
                                            <a href="{{ route('specialties.show', $specialty->slug) }}"
                                                class="manage-link-custom">
                                                Manage {{ $specialty->name }} <i class="mdi mdi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Service Modal --}}
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-primary text-white border-0"
                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title fw-bold">Edit Medical Service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="editServiceForm" action="{{ route('services.update', $service->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Service Name</label>
                                <input type="text" name="name" id="edit_service_name" class="form-control rounded-3"
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Subtitle</label>
                                <input type="text" name="subtitle" id="edit_service_subtitle"
                                    class="form-control rounded-3">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" id="edit_service_description" class="form-control rounded-3" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Price (EGP)</label>
                                <input type="number" name="price" id="edit_service_price"
                                    class="form-control rounded-3" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Duration (Min)</label>
                                <input type="number" name="duration" id="edit_service_duration"
                                    class="form-control rounded-3">
                            </div>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="featured_service"
                                id="edit_service_featured" value="1" style="margin: 2px 20px 0 19px;">
                            <label class="form-check-label fw-bold" for="edit_service_featured">Mark as Featured
                                Service</label>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light fw-bold px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Show Details Modal --}}
    <div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div id="modalServiceImageContainer" style="display: none;">
                    <img id="modalServiceImage" src="" class="img-fluid w-100"
                        style="height: 200px; object-fit: cover;" alt="Service">
                </div>
                <div class="modal-header bg-info text-white border-0 p-4">
                    <div>
                        <h5 class="modal-title fw-bold mb-0" id="modalServiceName">Service Details</h5>
                        <small id="modalServiceSubtitle" class="text-white-50 d-block mt-1"></small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex gap-2 mb-3">
                        <div class="badge bg-primary-subtle text-primary p-2 rounded-pill px-3">
                            <i class="mdi mdi-tag-outline me-1"></i> <span id="modalSpecialtyName"></span>
                        </div>
                        <div id="featuredBadge" class="badge bg-warning-subtle text-warning p-2 rounded-pill px-3"
                            style="display: none;">
                            <i class="mdi mdi-star me-1"></i> Featured Service
                        </div>
                    </div>
                    <h6 class="fw-bold text-dark"><i class="mdi mdi-information-outline me-1"></i> Description:</h6>
                    <p class="text-muted small mb-4" id="modalServiceDescription"></p>
                    <div id="featuresSection" class="mb-4" style="display: none;">
                        <h6 class="fw-bold text-dark"><i class="mdi mdi-check-decagram me-1"></i> Service Inclusions:</h6>
                        <ul id="modalServiceFeatures" class="list-unstyled small text-muted ps-2 mt-2"></ul>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="bg-light p-3 rounded-3 text-center">
                                <span class="text-muted d-block small mb-1">Price</span>
                                <span class="h5 mb-0 fw-bold text-primary" id="modalServicePrice"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light p-3 rounded-3 text-center">
                                <span class="text-muted d-block small mb-1">Duration</span>
                                <span class="h5 mb-0 fw-bold text-dark" id="modalServiceDuration"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-5 w-100"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden Delete Form --}}
    <form id="delete-service-form" action="{{ route('services.destroy', $service->id) }}" method="POST"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            function confirmDeleteService(id, name) {
                if (confirm(`Are you sure you want to delete the service: "${name}"?`)) {
                    const form = document.getElementById('delete-service-form');
                    // Setting action to the standard resource destroy route
                    // form.action = `/services/${id}`;
                    form.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Edit Modal Logic
                const editModal = document.getElementById('editServiceModal');
                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');

                    document.getElementById('editServiceForm').action = `services/${id}`;
                    document.getElementById('edit_service_name').value = button.getAttribute('data-name');
                    document.getElementById('edit_service_subtitle').value = button.getAttribute(
                        'data-subtitle');
                    document.getElementById('edit_service_description').value = button.getAttribute(
                        'data-description');
                    document.getElementById('edit_service_price').value = button.getAttribute('data-price');
                    document.getElementById('edit_service_duration').value = button.getAttribute(
                        'data-duration');
                    document.getElementById('edit_service_featured').checked = button.getAttribute(
                        'data-featured') == "1";
                });

                // Detail Modal Logic
                const detailModal = document.getElementById('serviceDetailModal');
                detailModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    document.getElementById('modalServiceName').textContent = button.getAttribute('data-name');
                    document.getElementById('modalServiceSubtitle').textContent = button.getAttribute(
                        'data-subtitle') || '';
                    document.getElementById('modalSpecialtyName').textContent = button.getAttribute(
                        'data-specialty');
                    document.getElementById('modalServiceDescription').textContent = button.getAttribute(
                        'data-description');
                    document.getElementById('modalServicePrice').textContent = button.getAttribute(
                        'data-price') + ' EGP';
                    document.getElementById('modalServiceDuration').textContent = button.getAttribute(
                        'data-duration') + ' min';

                    const imgSrc = button.getAttribute('data-image');
                    const imgCont = document.getElementById('modalServiceImageContainer');
                    if (imgSrc) {
                        document.getElementById('modalServiceImage').src = imgSrc;
                        imgCont.style.display = 'block';
                    } else {
                        imgCont.style.display = 'none';
                    }

                    document.getElementById('featuredBadge').style.display = button.getAttribute(
                        'data-featured') == "1" ? 'block' : 'none';

                    const featuresList = document.getElementById('modalServiceFeatures');
                    const featuresSection = document.getElementById('featuresSection');
                    featuresList.innerHTML = '';

                    try {
                        const features = JSON.parse(button.getAttribute('data-features'));
                        if (features && Array.isArray(features) && features.length > 0) {
                            featuresSection.style.display = 'block';
                            features.forEach(f => {
                                if (f) featuresList.innerHTML +=
                                    `<li><i class="mdi mdi-check text-success me-2"></i>${f}</li>`;
                            });
                        } else {
                            featuresSection.style.display = 'none';
                        }
                    } catch (e) {
                        featuresSection.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
@endsection
