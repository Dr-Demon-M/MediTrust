@extends('layouts.dashboardLayout')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card shadow-sm border-0 bg-white main-add-card">
                <div class="card-body p-5">

                    {{-- هيدر الفورم --}}
                    <div class="text-center mb-5">
                        <div class="icon-circle-header mx-auto mb-3">
                            <i class="mdi mdi-medical-bag text-primary"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Add New Medical Service</h3>
                        <p class="text-muted small">Fill in the details below to define a new service for the clinic</p>
                    </div>

                    <form action="{{ route('services.store') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="row">
                            {{-- اسم الخدمة --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label-custom">Service Name</label>
                                <div class="input-group-custom" >
                                    <span class="input-icon"><i class="mdi mdi-format-title"></i></span>
                                    <input type="text" name="name" class="form-control input-field"
                                        placeholder="e.g. Heart Consultation" required style="color: black;">
                                </div>
                            </div>

                            {{-- اختيار التخصص --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom">Specialty / Department</label>
                                <select name="specialty_id" class="form-select select-field" required style="color: black;">
                                    <option value="" selected disabled>Choose Specialty...</option>
                                    @foreach ($specialities as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- السعر --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom">Service Price (EGP)</label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="mdi mdi-cash"></i></span>
                                    <input type="number" name="price" class="form-control input-field" placeholder="0.00"
                                        required style="color: black;">
                                </div>
                            </div>

                            {{-- مدة الكشف --}}
                            {{-- استبدل الجزء الخاص بالـ Duration والـ Switch بهذا الكود --}}
                            <div class="row align-items-center mb-4">
                                {{-- مدة الكشف --}}
                                <div class="col-md-6">
                                    <label class="form-label-custom">Estimated Duration (Min)</label>
                                    <select name="duration" class="form-select select-field" style="color: black;">
                                        <option value="15">15 Minutes</option>
                                        <option value="30" selected>30 Minutes</option>
                                        <option value="45">45 Minutes</option>
                                        <option value="60">1 Hour</option>
                                    </select>
                                </div>

                                {{-- التعديل هنا: وضع الزرار في مساحة مستقلة مع ضبط المحاذاة --}}
                                <div class="col-md-6 d-flex align-items-center justify-content-start mt-4">
                                    <div class="form-check form-switch featured-switch-container">
                                        <input class="form-check-input custom-switch-input" type="checkbox"
                                            name="is_featured" id="featuredService">
                                        <label class="form-check-label fw-bold ms-3" for="featuredService"
                                            style="cursor: pointer; color: #1F3BB3;">
                                            Mark as Featured Service
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- الوصف --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label-custom">Service Description (Optional)</label>
                                <textarea name="description" class="form-control text-area-field" rows="4"
                                    placeholder="Briefly describe the service or preparation needed..."></textarea>
                            </div>
                        </div>

                        {{-- أزرار التحكم --}}
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary btn-save px-5 me-3">
                                <i class="mdi mdi-check-circle-outline me-2"></i>Save Service
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-light btn-cancel px-5">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
