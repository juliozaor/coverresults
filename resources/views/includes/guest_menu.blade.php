<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" aria-label="Offcanvas navbar large">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img class="img-fluid" width="180px"
                src="{{ asset('assets/dist/img/logo.svg') }}" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-ligh" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#funtions">Funtions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#specs">Specification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}"
                            class="d-inline-flex align-items-center btn btn-primary px-4 rounded-pill" type="button">
                            login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
