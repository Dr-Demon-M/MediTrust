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
                                                    data-specialty="{{ $specialty->name }}"
                                                    data-description="{{ $service->description ?? 'No description available.' }}"
                                                    data-price="{{ $service->price ?? '0' }}" style="cursor: pointer;">
                                                    <i
                                                        class="mdi mdi-check-circle-outline text-success me-2 small-icon"></i>
                                                    <span class="text-primary fw-medium large">{{ $service->name }}</span>
                                                </div>

                                                <div class="quick-actions-container d-flex align-items-center ms-2">
                                                    @can('edit', $service)
                                                        <button class="btn btn-link text-primary p-0 me-2 quick-edit-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editServiceModal"
                                                            data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                                            data-description="{{ $service->description }}"
                                                            data-price="{{ $service->price }}">
                                                            <i class="mdi mdi-pencil-outline"></i>
                                                        </button>
                                                    @endcan
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

    {{-- مودال تعديل الخدمة (جديد) --}}
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-primary text-white border-0"
                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title fw-bold">Edit Medical Service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="editServiceForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Service Name</label>
                            <input type="text" name="name" id="edit_service_name" class="form-control rounded-3"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" id="edit_service_description" class="form-control rounded-3" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Consultation Fee (EGP)</label>
                            <input type="number" name="price" id="edit_service_price" class="form-control rounded-3"
                                required>
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

    {{-- مودال عرض التفاصيل --}}
    <div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-info text-white border-0"
                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title fw-bold" id="modalServiceName">Service Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="badge bg-primary-subtle text-primary p-2 rounded-pill px-3 mb-3">
                        <i class="mdi mdi-tag-outline me-1"></i> <span id="modalSpecialtyName"></span>
                    </div>
                    <h6 class="fw-bold text-dark">Description:</h6>
                    <p class="text-muted small mb-4" id="modalServiceDescription"></p>
                    <div class="bg-light p-3 rounded-3 d-flex justify-content-between">
                        <span class="fw-bold">Price:</span>
                        <span class="h5 mb-0 fw-bold text-primary" id="modalServicePrice"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- فورم الحذف المخفي --}}
    <form id="delete-service-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            function confirmDeleteService(id, name) {
                if (confirm(`Are you sure you want to delete: "${name}"?`)) {
                    const form = document.getElementById('delete-service-form');
                    form.action = `/services/${id}`;
                    form.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // مبرمج مودال التعديل
                const editModal = document.getElementById('editServiceModal');
                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');

                    document.getElementById('editServiceForm').action = `/services/${id}`;
                    document.getElementById('edit_service_name').value = button.getAttribute('data-name');
                    document.getElementById('edit_service_description').value = button.getAttribute(
                        'data-description');
                    document.getElementById('edit_service_price').value = button.getAttribute('data-price');
                });

                // مبرمج مودال التفاصيل
                const detailModal = document.getElementById('serviceDetailModal');
                detailModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    document.getElementById('modalServiceName').textContent = button.getAttribute('data-name');
                    document.getElementById('modalSpecialtyName').textContent = button.getAttribute(
                        'data-specialty');
                    document.getElementById('modalServiceDescription').textContent = button.getAttribute(
                        'data-description');
                    document.getElementById('modalServicePrice').textContent = button.getAttribute(
                        'data-price') + ' EGP';
                });
            });
        </script>
    @endpush
@endsection
