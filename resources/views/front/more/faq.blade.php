@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title position-relative">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a></li>
                        <li class="breadcrumb-item active current">Frequently Asked Questions</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Frequently Asked Questions</h1>
                <p>Find answers to the most common questions about booking appointments, visiting our clinic, and
                    receiving medical care.</p>
            </div>
        </div><!-- End Page Title -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">

                    <!-- Contact Card -->
                    <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="200">
                        <div class="faq-contact-card">
                            <div class="card-icon">
                                <i class="bi bi-question-circle"></i>
                            </div>
                            <div class="card-content">
                                <h3>Still Have Questions?</h3>
                                <p>If you couldn't find the answer you were looking for, our support team is always ready
                                    to help you. Feel free to contact us using any of the options below.</p>

                                <div class="contact-options">
                                    <a href="mailto:support@meditrust.com" class="contact-option">
                                        <i class="bi bi-envelope"></i>
                                        <span>Email Support</span>
                                    </a>

                                    <a href="https://wa.me/201093808945" class="contact-option" target="_blank">
                                        <i class="bi bi-chat-dots"></i>
                                        <span>Send a Message</span>
                                    </a>

                                    <a href="tel:+201001234567" class="contact-option">
                                        <i class="bi bi-telephone"></i>
                                        <span>Call Us</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Accordion -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="faq-accordion">

                            <div class="faq-item faq-active">
                                <div class="faq-header">
                                    <h3>How can I book an appointment?</h3>
                                    <i class="bi bi-chevron-down faq-toggle"></i>
                                </div>
                                <div class="faq-content">
                                    <p>
                                        You can easily book an appointment through our online booking system. Simply choose
                                        the medical service you need, select your preferred doctor, and pick a suitable
                                        date and time.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-header">
                                    <h3>Can I cancel or reschedule my appointment?</h3>
                                    <i class="bi bi-chevron-down faq-toggle"></i>
                                </div>
                                <div class="faq-content">
                                    <p>
                                        Yes, you can cancel or reschedule your appointment from your profile dashboard or
                                        by contacting our clinic before the appointment time.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-header">
                                    <h3>Do I need to create an account to book an appointment?</h3>
                                    <i class="bi bi-chevron-down faq-toggle"></i>
                                </div>
                                <div class="faq-content">
                                    <p>
                                        Creating an account allows you to manage your appointments, track your medical
                                        history, and receive notifications about upcoming visits.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-header">
                                    <h3>What should I bring to my first visit?</h3>
                                    <i class="bi bi-chevron-down faq-toggle"></i>
                                </div>
                                <div class="faq-content">
                                    <p>
                                        Please bring your identification card, any previous medical reports, prescriptions,
                                        and a list of medications you are currently taking.
                                    </p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-header">
                                    <h3>Can I upload my medical reports before visiting?</h3>
                                    <i class="bi bi-chevron-down faq-toggle"></i>
                                </div>
                                <div class="faq-content">
                                    <p>
                                        Yes, patients can upload medical reports and documents directly from their
                                        profile. This helps the doctor review your case before your appointment.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>
@endsection