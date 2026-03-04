@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a></li>
                        <li class="breadcrumb-item active current">Terms</li>
                    </ol>
                </nav>
            </div>

        </div><!-- End Page Title -->

        <!-- Terms Of Service Section -->
        <section id="terms-of-service" class="terms-of-service section" style="padding-top: 10px">

            <div class="container" data-aos="fade-up">
                <!-- Page Header -->
                <div class="tos-header text-center" data-aos="fade-up">
                    <span class="last-updated">Last Updated: March 3, 2026</span>
                    <h2>Terms of Service</h2>
                    <p>Please read these terms of service carefully before using our services</p>
                </div>

                <!-- Content -->
                <div class="tos-content" data-aos="fade-up" data-aos-delay="200">
                    <!-- Agreement Section -->
                    <div id="agreement" class="content-section">
                        <h3>1. Agreement to Terms</h3>
                        <p>By accessing or using our website and medical services, you agree to comply with and be bound by
                            these Terms of Service and all applicable laws and regulations. If you do not agree with these
                            terms, you should not use our services.</p>
                        <div class="info-box">
                            <i class="bi bi-info-circle"></i>
                            <p>These Terms apply to all users, including visitors, registered patients, and anyone accessing
                                our platform.</p>
                        </div>
                    </div>

                    <!-- Medical Disclaimer -->
                    <div id="intellectual-property" class="content-section">
                        <h3>2. Medical Disclaimer</h3>
                        <p>Our online consultations and medical content are intended for informational purposes only and do
                            not replace in-person medical examinations when required. In case of emergency, please contact
                            local emergency services immediately.</p>
                    </div>

                    <!-- User Accounts -->
                    <div id="user-accounts" class="content-section">
                        <h3>3. User Accounts</h3>
                        <p>When creating an account, you agree to provide accurate, complete, and up-to-date information.
                            You are responsible for maintaining the confidentiality of your login credentials and for all
                            activities that occur under your account.</p>
                        <div class="alert-box">
                            <i class="bi bi-exclamation-triangle"></i>
                            <div class="alert-content">
                                <h5>Important Notice</h5>
                                <p>We reserve the right to suspend or terminate accounts that provide false information or
                                    violate these Terms.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Appointments & Payments -->
                    <div id="prohibited" class="content-section">
                        <h3>4. Appointments & Payments</h3>
                        <p>Appointments must be booked through our official channels. Payment policies, cancellation rules,
                            and refund terms are clearly stated during the booking process. By confirming a booking, you
                            agree to these policies.</p>
                    </div>

                    <!-- Intellectual -->
                    <div id="disclaimer" class="content-section">
                        <h3>5. Intellectual Property</h3>
                        <p>All website content, including text, graphics, logos, images, and design elements, is the
                            exclusive property of our clinic and is protected under applicable intellectual property laws.
                        </p>
                    </div>

                    <!-- Prohibited Activities -->
                    <div id="prohibited" class="content-section">
                        <h3>4. Prohibited Activities</h3>
                        <p>You agree not to:</p>
                        <div class="prohibited-list">
                            <div class="prohibited-item">
                                <i class="bi bi-x-circle"></i>
                                <span>Use the platform for unlawful purposes</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="bi bi-x-circle"></i>
                                <span>Attempt unauthorized access to our systems</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="bi bi-x-circle"></i>
                                <span>Upload malicious or harmful content</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="bi bi-x-circle"></i>
                                <span>Interfere with the website’s security or functionality</span>
                            </div>
                        </div>
                    </div>

                    <!-- Limitation -->
                    <div id="indemnification" class="content-section">
                        <h3>7. Limitation of Liability</h3>
                        <p>We are not liable for any indirect, incidental, or consequential damages resulting from the use
                            or inability to use our services. The website and services are provided on an "as available"
                            basis without warranties of any kind.</p>
                    </div>

                    <!-- Termination -->
                    <div id="termination" class="content-section">
                        <h3>8. Termination</h3>
                        <p>We may terminate or suspend your account immediately, without prior notice or liability, for any
                            reason whatsoever, including without limitation if you breach the Terms.</p>
                    </div>

                    <!-- Privacy -->
                    <div id="governing-law" class="content-section">
                        <h3>9. Privacy</h3>
                        <p>Your personal and medical information is handled in accordance with our Privacy Policy. By using
                            our services, you consent to the collection and use of information as described therein.</p>
                    </div>

                    <!-- Changes -->
                    <div id="changes" class="content-section">
                        <h3>10. Changes to Terms</h3>
                        <p>We reserve the right to update or modify these Terms at any time. Continued use of our services
                            after changes are posted constitutes acceptance of the revised Terms.</p>
                        <div class="notice-box">
                            <i class="bi bi-bell"></i>
                            <p>By continuing to access or use our service after those revisions become effective, you agree
                                to be bound by the revised terms.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="tos-contact" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="contact-content">
                            <h4>Questions About Terms?</h4>
                            <p>If you have any questions about these Terms, please contact us.</p>
                            <a href="#" class="contact-link">Contact Support</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Terms Of Service Section -->

    </main>
@endsection
