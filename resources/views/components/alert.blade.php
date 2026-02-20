@if (session('success') || session('error') || session('info') || session('updated') || $errors->any())
    <div class="alert-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px opacity:1 !important;">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="Opacity:1 !important;">
                <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Error Message (Custom or Validation) --}}
        @if (session('error') || $errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="Opacity:1 !important;">
                <i class="mdi mdi-alert-circle me-2"></i>
                @if (session('error'))
                    {{ session('error') }}
                @else
                    Please check the form for errors.
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Info Message --}}
        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm" role="alert" style="Opacity:1 !important;">
                <i class="mdi mdi-information me-2"></i> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Updated Message --}}
        @if (session('updated'))
            <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm" role="alert"
                style="background-color: #fff3cd; color: #856404; opacity:1 !important;">
                <i class="mdi mdi-refresh me-2"></i> {{ session('updated') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
@endif
