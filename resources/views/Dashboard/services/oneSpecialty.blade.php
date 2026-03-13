@extends('layouts.dashboardLayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/clinic-services.css') }}?v={{ time() }}">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card specialty-detail-card border-0 shadow-sm">
                    <div class="card-header-custom p-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center">
                                <div class="specialty-icon-wrapper me-3">
                                    <i class="mdi {{ $specialty->icon }}"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $specialty->name }}</h3>
                                    <p class="text-muted mb-0">Management of medical services for this department</p>
                                </div>
                            </div>
                            <div class="actions mt-3 mt-md-0">
                                @can('create', App\Models\Service::class)
                                    <a href="{{ route('services.create', ['specialty_id' => $specialty->id]) }}"
                                        class="btn btn-primary btn-add-service px-4">
                                        <i class="mdi mdi-plus-circle-outline me-2"></i> Add New Service
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Subtitle</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($specialty->services as $service)
                                        <tr>
                                            <td class="fw-bold text-primary">
                                                <span class="service-clickable" data-bs-toggle="modal"
                                                    data-bs-target="#serviceDetailModal" data-id="{{ $service->id }}"
                                                    data-name="{{ $service->name }}" data-subtitle="{{ $service->subtitle }}"
                                                    data-specialty="{{ $specialty->name }}"
                                                    data-description="{{ $service->description ?? 'No description available.' }}"
                                                    data-price="{{ $service->price ?? '0' }}"
                                                    data-duration="{{ $service->duration ?? '--' }}"
                                                    data-featured="{{ $service->featured_service }}"
                                                    data-image="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                                                    data-features='@json($service->features ?? [])'>
                                                    {{ $service->name }}
                                                </span>
                                            </td>
                                            <td class="text-muted small">{{ Str::limit($service->subtitle, 30) }}</td>
                                            <td><span class="badge bg-success-subtle text-success">{{ $service->price }}
                                                    EGP</span></td>
                                            <td><i class="mdi mdi-clock-outline me-1"></i> {{ $service->duration }} min</td>
                                            <td>
                                                @if($service->featured_service)
                                                    <span class="badge bg-warning text-white"><i class="mdi mdi-star"></i>
                                                        Featured</span>
                                                @else
                                                    <span class="badge bg-light text-muted">Standard</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                                                        data-bs-target="#editServiceModal" data-id="{{ $service->id }}"
                                                        data-name="{{ $service->name }}"
                                                        data-subtitle="{{ $service->subtitle }}"
                                                        data-description="{{ $service->description }}"
                                                        data-price="{{ $service->price }}"
                                                        data-duration="{{ $service->duration }}"
                                                        data-featured="{{ $service->featured_service }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="confirmDeleteService('{{ $service->id }}', '{{ $service->name }}')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="mdi mdi-alert-circle-outline d-block mb-2"
                                                    style="font-size: 2rem;"></i>
                                                No services found for this specialty.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Service Modal --}}
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg modal-rounded">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title fw-bold">Edit Medical Service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="editServiceForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Service Name</label>
                                <input type="text" name="name" id="edit_service_name" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Subtitle</label>
                                <input type="text" name="subtitle" id="edit_service_subtitle" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" id="edit_service_description" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Price (EGP)</label>
                                <input type="number" name="price" id="edit_service_price" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label fw-bold">Duration (Min)</label>
                                <input type="number" name="duration" id="edit_service_duration" class="form-control">
                            </div>
                        </div>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="featured_service"
                                id="edit_service_featured" value="1">
                            <label class="form-check-label fw-bold ms-2" for="edit_service_featured">Mark as Featured
                                Service</label>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Show Details Modal --}}
    <div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg modal-rounded overflow-hidden">
                <div id="modalServiceImageContainer" style="display: none;">
                    <img id="modalServiceImage" src="" class="img-fluid w-100" style="height: 200px; object-fit: cover;"
                        alt="Service">
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
                            <i class="mdi mdi-star me-1"></i> Featured
                        </div>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Description:</h6>
                    <p class="text-muted small mb-4" id="modalServiceDescription"></p>

                    <div id="featuresSection" class="mb-4" style="display: none;">
                        <h6 class="fw-bold text-dark mb-2">Service Inclusions:</h6>
                        <ul id="modalServiceFeatures" class="list-unstyled small text-muted ps-2 mt-2"></ul>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="bg-light p-3 rounded-3 text-center border">
                                <span class="text-muted d-block small mb-1">Price</span>
                                <span class="h5 mb-0 fw-bold text-primary" id="modalServicePrice"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light p-3 rounded-3 text-center border">
                                <span class="text-muted d-block small mb-1">Duration</span>
                                <span class="h5 mb-0 fw-bold text-dark" id="modalServiceDuration"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden Delete Form --}}
    <form id="delete-service-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            function confirmDeleteService(id, name) {
                if (confirm(`Are you sure you want to delete "${name}"?`)) {
                    const form = document.getElementById('delete-service-form');
                    let url = "{{ route('specialty.services.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    form.action = url;
                    form.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const editModal = document.getElementById('editServiceModal');
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');

                    let url = "{{ route('specialty.services.update', ':id') }}";

                    url = url.replace(':id', id);

                    const form = document.getElementById('editServiceForm');
                    form.action = url;

                    document.getElementById('edit_service_name').value = button.getAttribute('data-name');
                    document.getElementById('edit_service_subtitle').value = button.getAttribute('data-subtitle');
                    document.getElementById('edit_service_description').value = button.getAttribute('data-description');
                    document.getElementById('edit_service_price').value = button.getAttribute('data-price');
                    document.getElementById('edit_service_duration').value = button.getAttribute('data-duration');
                    document.getElementById('edit_service_featured').checked = button.getAttribute('data-featured') == "1";
                });

                const detailModal = document.getElementById('serviceDetailModal');
                detailModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    document.getElementById('modalServiceName').textContent = button.getAttribute('data-name');
                    document.getElementById('modalServiceSubtitle').textContent = button.getAttribute('data-subtitle') || '';
                    document.getElementById('modalSpecialtyName').textContent = button.getAttribute('data-specialty');
                    document.getElementById('modalServiceDescription').textContent = button.getAttribute('data-description');
                    document.getElementById('modalServicePrice').textContent = button.getAttribute('data-price') + ' EGP';
                    document.getElementById('modalServiceDuration').textContent = button.getAttribute('data-duration') + ' min';

                    const imgSrc = button.getAttribute('data-image');
                    const imgCont = document.getElementById('modalServiceImageContainer');
                    if (imgSrc) {
                        document.getElementById('modalServiceImage').src = imgSrc;
                        imgCont.style.display = 'block';
                    } else {
                        imgCont.style.display = 'none';
                    }

                    document.getElementById('featuredBadge').style.display = button.getAttribute('data-featured') == "1" ? 'block' : 'none';

                    const featuresList = document.getElementById('modalServiceFeatures');
                    const featuresSection = document.getElementById('featuresSection');
                    featuresList.innerHTML = '';
                    try {
                        const features = JSON.parse(button.getAttribute('data-features'));
                        if (features && features.length > 0) {
                            featuresSection.style.display = 'block';
                            features.forEach(f => {
                                if (f) featuresList.innerHTML += `<li><i class="mdi mdi-check text-success me-2"></i>${f}</li>`;
                            });
                        } else {
                            featuresSection.style.display = 'none';
                        }
                    } catch (e) { featuresSection.style.display = 'none'; }
                });
            });
        </script>
    @endpush
@endsection