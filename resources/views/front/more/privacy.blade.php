@extends('layouts.frontLayout')

@section('content')
<main class="main clinic-privacy-page">

    <div class="page-title shadow-sm">
        <div class="container text-center">
            <div class="privacy-icon-wrapper mb-3">
                <i class="bi bi-shield-check"></i>
            </div>
            <h1>Privacy Policy</h1>
            <p class="lead">Your privacy and medical data security are our top priorities at MediTrust.</p>
            <div class="last-updated">Effective Date: March 2026</div>
        </div>
    </div>

    <section class="privacy-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="policy-card shadow-sm p-4 p-md-5 bg-white">
                        
                        <div class="intro-text mb-5">
                            <p>This Privacy Policy explains how we collect, use, protect, and manage your personal and medical information when you use our website and services.</p>
                        </div>

                        <div class="policy-section">
                            <h3><span class="section-num">1</span> Information We Collect</h3>
                            <div class="subsection">
                                <h4>1.1 Personal Information</h4>
                                <p>When booking an appointment or creating an account, we may collect:</p>
                                <ul>
                                    <li>Full name, Email address, and phone number</li>
                                    <li>Date of birth and Appointment details</li>
                                    <li>Payment information (when applicable)</li>
                                </ul>
                            </div>
                            <div class="subsection">
                                <h4>1.2 Medical Information</h4>
                                <p>For consultations and diagnostic services, we may collect:</p>
                                <ul>
                                    <li>Symptoms and medical history</li>
                                    <li>Consultation notes and Test results</li>
                                    <li>Prescriptions and treatment plans</li>
                                </ul>
                            </div>
                        </div>

                        <div class="policy-section">
                            <h3><span class="section-num">2</span> How We Use Your Information</h3>
                            <p>We use your information to schedule appointments, provide medical consultations, process payments, and improve our services. <strong>We do not sell or rent your personal information to third parties.</strong></p>
                        </div>

                        <div class="policy-section">
                            <h3><span class="section-num">3</span> Information Sharing</h3>
                            <p>We share data only with medical professionals involved in your care, secure payment providers, or when required by law.</p>
                        </div>

                        <div class="policy-section highlight-box">
                            <h3><i class="bi bi-lock-fill me-2"></i> 4. Data Security</h3>
                            <p>We implement SSL encryption, secure servers, and regular monitoring. While we strive for absolute security, no internet transmission is 100% secure.</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="policy-section">
                                    <h3><span class="section-num">5</span> Data Retention</h3>
                                    <p>Information is kept only as long as necessary for medical services and legal compliance.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="policy-section">
                                    <h3><span class="section-num">6</span> Your Rights</h3>
                                    <p>You have the right to access, correct, or delete your data and withdraw consent at any time.</p>
                                </div>
                            </div>
                        </div>

                        <div class="contact-footer mt-5 p-4 rounded text-center">
                            <h3>Contact Us</h3>
                            <p>If you have any questions, reach out to our support team:</p>
                            <div class="d-flex flex-wrap justify-content-center gap-4 mt-3">
                                <span><i class="bi bi-envelope text-primary me-2"></i> support@meditrust.com</span>
                                <span><i class="bi bi-telephone text-primary me-2"></i> +20 100 123 4567</span>
                                <span><i class="bi bi-geo-alt text-primary me-2"></i> Cairo, Egypt</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection