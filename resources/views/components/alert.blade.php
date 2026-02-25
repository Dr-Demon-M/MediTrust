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
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ابحث عن كل التنبيهات التي تظهر في الصفحة
        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(function(alert) {
            // انتظر 5 ثوانٍ (5000 ميلي ثانية) قبل البدء في الإخفاء
            setTimeout(function() {
                // إضافة تأثير اختفاء ناعم (Fade out)
                alert.style.transition = "opacity 0.6s ease";
                alert.style.opacity = "0";
                
                // حذف العنصر تماماً من الصفحة بعد انتهاء تأثير الاختفاء
                setTimeout(function() {
                    alert.remove();
                }, 600); 
            }, 5000);
        });
    });
</script>