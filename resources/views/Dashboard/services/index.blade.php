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
                        <a href="{{ route('services.create') }}"
                            class="btn btn-primary d-flex align-items-center text-white px-4 py-2"
                            style="border-radius: 10px; font-weight: 600;">
                            <i class="mdi mdi-plus-circle-outline me-2"></i> Add New Service
                        </a>
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
                                                {{-- منطقة الضغط لفتح المودال --}}
                                                <div class="service-item-clickable d-flex align-items-center flex-grow-1"
                                                    data-bs-toggle="modal" data-bs-target="#serviceDetailModal"
                                                    data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                                    data-specialty="{{ $specialty->name }}"
                                                    data-description="{{ $service->description ?? 'No description available for this service.' }}"
                                                    data-price="{{ $service->price ?? '0' }}" style="cursor: pointer;">

                                                    <i
                                                        class="mdi mdi-check-circle-outline text-success me-2 small-icon"></i>
                                                    <span class="text-primary fw-medium large">{{ $service->name }}</span>
                                                </div>

                                                {{-- زر الحذف السريع --}}
                                                <button class="btn btn-link text-danger p-0 ms-2 quick-delete-btn"
                                                    onclick="confirmDeleteService('{{ $service->id }}', '{{ $service->name }}')">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </button>
                                            </li>
                                        @empty
                                            <div class="col-12 text-center my-5 py-5">
                                                <div class="empty-state-container">
                                                    <div class="empty-icon-wrapper mb-4">
                                                        <i class="mdi mdi-sticker-emoji text-muted"></i>
                                                    </div>
                                                    <h4 class="fw-bold text-dark">No Services Found</h4>
                                                    <p class="text-muted mx-auto" style="max-width: 400px;">
                                                        It looks like there are no services registered in the clinic yet.
                                                        Start by adding your first medical service to display it here.
                                                    </p>
                                                    <a href="{{ route('services.create') }}"
                                                        class="btn btn-primary mt-3 px-4 py-2" style="border-radius: 10px;">
                                                        <i class="mdi mdi-plus-circle-outline me-2"></i>Add First Service
                                                    </a>
                                                </div>
                                            </div>
                                        @endforelse
                                    </ul>

                                    <div class="mt-auto pt-4 text-center">
                                        <a href="{{ route('specialties.show', $specialty->slug) }}"
                                            class="manage-link-custom">
                                            Manage {{ $specialty->name }} <i class="mdi mdi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- مودال عرض التفاصيل --}}
    <div class="modal fade" id="serviceDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-primary text-white border-0"
                    style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title fw-bold" id="modalServiceName">Service Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="badge bg-primary-subtle text-primary p-2 rounded-pill px-3">
                            <i class="mdi mdi-tag-outline me-1"></i> <span id="modalSpecialtyName"></span>
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark mb-2">Description:</h6>
                    <p class="text-muted small mb-4" id="modalServiceDescription"></p>

                    <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3">
                        <span class="fw-bold text-dark">Consultation Fee:</span>
                        <span class="h5 mb-0 fw-bold text-primary" id="modalServicePrice"></span>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger fw-bold px-4" id="modalDeleteBtn"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-delete me-1"></i> Delete
                    </button>
                    <button type="button" class="btn btn-light fw-bold px-4" data-bs-dismiss="modal"
                        style="border-radius: 10px;">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- فورم الحذف المخفي --}}
    <form id="delete-service-form" action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            let currentServiceId = null;
            let currentServiceName = "";

            // دالة تأكيد الحذف
            function confirmDeleteService(id, name) {
                if (confirm(`Are you sure you want to delete the service: "${name}"?`)) {
                    const form = document.getElementById('delete-service-form');
                    form.action = `/services/${id}`; // تأكد من صحة مسار الـ Route
                    form.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const serviceModal = document.getElementById('serviceDetailModal');

                serviceModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    // استخراج البيانات
                    currentServiceId = button.getAttribute('data-id');
                    currentServiceName = button.getAttribute('data-name');
                    const specialty = button.getAttribute('data-specialty');
                    const description = button.getAttribute('data-description');
                    const price = button.getAttribute('data-price');

                    // ملء المودال
                    document.getElementById('modalServiceName').textContent = currentServiceName;
                    document.getElementById('modalSpecialtyName').textContent = specialty;
                    document.getElementById('modalServiceDescription').textContent = description;
                    document.getElementById('modalServicePrice').textContent = price + ' EGP';
                });

                // تفعيل الحذف من داخل المودال
                document.getElementById('modalDeleteBtn').onclick = function() {
                    if (currentServiceId) {
                        confirmDeleteService(currentServiceId, currentServiceName);
                    }
                };
            });
        </script>
    @endpush
@endsection
