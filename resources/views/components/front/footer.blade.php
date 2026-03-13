<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
        <div class="row gy-4 pb-3" style="display: flex;align-content: flex-end;justify-content: space-between;">
            <div class=" col-lg-2 col-md-6 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename">MediTrust</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>15 Ahmed Orabi St, Dokki</p>
                    <p>Giza, Egypt</p>
                    <a class="mt-3" href="tel:+201001234567" class="text-decoration-none"><strong>Phone:</strong> <span>+20 100 123 4567</span></a>
                    <a href="mailto:support@meditrust.com" class="text-decoration-none"><strong>Email:</strong> <span>support@meditrust.com</span></a>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{route('front.home')}}">Home</a></li>
                    <li><a href="{{ route('front.about.index') }}">About us</a></li>
                    <li><a href="{{ route('front.services.index') }}">Services</a></li>
                    <li><a href="{{ route('front.terms.index') }}">Terms of service</a></li>
                    <li><a href="{{ route('front.privacy.index') }}">Privacy policy</a></li>
                </ul>
            </div>


            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Sections</h4>
                <ul>
                    <li><a href="{{ route('front.departments.index') }}">Departments</a></li>
                    <li><a href="{{ route('front.doctors.index') }}">Doctors</a></li>
                    <li><a href="{{ route('front.services.index') }}">Services</a></li>
                    <li><a href="{{route('front.contact.index')}}">Contact</a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>