@extends('layouts.dashboardLayout')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card m-1">
            <div class="card shadow-sm border-0 bg-white" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-5 mt-2 px-2">
                        <div>
                            <h4 class="fw-bold mb-1 text-primary">
                                <i class="mdi mdi-star text-warning me-2"></i>Featured Services
                            </h4>
                            <p class="text-muted small mb-0">High-priority services and special clinic programs</p>
                        </div>
                        @foreach ($specialities as $specialty)
                            @foreach ($specialty->services as $service)
                                @can('update', $service)
                                    <button class="btn btn-outline-primary fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#configureFeaturedModal" style="border-radius: 10px;">
                                        <i class="mdi mdi-settings me-2"></i>Configure Featured
                                    </button>
                                @endcan
                            @endforeach
                        @endforeach
                    </div>
                    <div class="row px-2">
                        @foreach ($specialities as $specialty)
                            @if ($specialities->count() > 0)
                                <div class="col-md-6 col-lg-3 mb-4 d-flex align-items-stretch"> {{-- align-items-stretch توحد الطول --}}
                                    <div class="featured-box p-4 d-flex flex-column shadow-sm w-100"
                                        style="border-radius: 15px; background: #fff; border: 1px solid #f0f0f0;">
                                        <div class="text-center mb-3">
                                            <div class="featured-icon-circle mx-auto mb-2 text-primary">
                                                <i class="mdi {{ $specialty->icon }}"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-0">{{ $specialty->name }}</h6>
                                        </div>
                                        <div class="services-list flex-grow-1">
                                            @foreach ($specialty->services as $service)
                                                <div class="featured-item-tag mb-2 d-flex align-items-center">
                                                    <i class="mdi mdi-star text-warning me-2" style="font-size: 14px;"></i>
                                                    <span class="small text-primary">{{ $service->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-4 pt-3 text-center border-top">
                                            <a href="{{ route('services.index') }}"
                                                class="manage-btn-featured text-decoration-none fw-bold small">
                                                Show All {{ strtoupper($specialty->name) }} Services <i
                                                    class="mdi mdi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="configureFeaturedModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 15px;">

                <div class="modal-header border-bottom-0 p-4">
                    <h5 class="fw-bold mb-0">Select Featured Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 pt-0">

                    <p class="text-muted small mb-4">
                        Select the services you want to highlight on the main dashboard.
                    </p>

                    <form id="featuredForm">
                        @csrf

                        <div style="max-height: 300px; overflow-y: auto;">

                            @foreach ($specialities as $specialty)
                                <div class="fw-bold text-primary small mb-2 mt-3">
                                    {{ $specialty->name }}
                                </div>

                                @foreach ($specialty->services as $service)
                                    <div class="form-check p-3 border rounded mb-2 d-flex align-items-center">
                                        <input class="form-check-input ms-0 me-3" type="checkbox"
                                            value="{{ $service->id }}" name="featured_services[]"
                                            id="service-{{ $service->id }}"
                                            {{ $service->featured_service ? 'checked' : '' }}>

                                        <label class="form-check-label mb-0" for="service-{{ $service->id }}">
                                            {{ $service->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endforeach

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold" style="border-radius: 10px;">
                                Update Featured List
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="successToast" class="toast align-items-center text-bg-success border-0">
            <div class="d-flex">
                <div class="toast-body">
                    Featured services updated successfully
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('featuredForm');
                if (!form) return;
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(form);
                    fetch("{{ route('services.update') }}", {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Updated successfully");
                                location.reload();
                            }
                        })
                        .catch(error => console.error(error));
                });
            });
        </script>
    @endpush
@endsection
