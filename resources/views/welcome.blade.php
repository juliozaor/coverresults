<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="{{ asset('assets/js/color-modes.js') }}"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.118.2">
        <title>Guardian Track by Covert Results</title>
        <link rel="icon" type="image/png" sizes="48x48" href="../assets/dist/img/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
        <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/dist/css/custom.css') }}" rel="stylesheet">
    </head>
    <body class="antialiased">
 {{--        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif               
        </div> --}}
                  
                     @if (Auth::check())
                        @include('includes.auth_menu')
                     @else
                        @include('includes.guest_menu')
                     @endif

         
      <main class="flex-shrink-0">
        <div class="banner-map" id="home">
           <div class="w-100 backpage mx-auto">
              <div class="container my-5 ">
                 <div class="row align-items-center">
                    <div class="col-md-6 py-4 my-md-5 order-1 order-md-0 text-center">
                       <img class="img-fluid align-items-center d-none d-md-block" src="{{ asset('assets/dist/img/logo.svg') }}"/>
                       <h2 class="text-body-emphasis">Guardian Track by Cover Results</h2>
                       <p class="text-muted">
                          In moments of managing special populations, discretion is paramount to respecting the dignity of each individual. We introduce our GPS Tracking Watch, a discreet device specifically designed for delicate situations such as community corrections, probation, residential surveillance, and house arrest.
                          With our GPS tracking watch, we ensure constant and discreet monitoring at all times, providing security without compromising the integrity of the individuals under supervision.
                       </p>
                    </div>
                    <div class="col-md-6 my-md-5 order-0 order-md-1 text-center">
                       <img class="d-block d-md-none img-fluid pt-5 px-4 align-items-center" src="{{ asset('assets/dist/img/logo.svg') }}"/>
                       <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
                          <div class="carousel-inner">
                             <div class="carousel-item active" data-bs-interval="3000">
                                <img class="img-fluid p-3 d-block w-100" src="{{ asset('assets/dist/img/smartwatch_2.png') }}"/>
                             </div>
                             <div class="carousel-item" data-bs-interval="1000">
                                <img class="img-fluid p-3 d-block w-100" src="{{ asset('assets/dist/img/smartwatch_3.png') }}"/>
                             </div>
                             <div class="carousel-item" data-bs-interval="1000">
                                <img class="img-fluid p-3 d-block w-100" src="{{ asset('assets/dist/img/smartwatch_4.png') }}"/>
                             </div>
                             <div class="carousel-item" data-bs-interval="1000">
                                <img class="img-fluid p-3 d-block w-100" src="{{ asset('assets/dist/img/smartwatch_5.png') }}"/>
                             </div>
                             <div class="carousel-item" data-bs-interval="1000">
                                <img class="img-fluid p-3 d-block w-100" src="{{ asset('assets/dist/img/smartwatch_6.png') }}"/>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class=" text-center rounded-3">
                    <div class="d-inline-flex gap-2 mb-5">
                       <a href="#funtions" class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                       Funtions
                       </a>
                       <a href="#specs" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                       Specs
                       </a>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="container-fluid backpage2 mx-auto" id="funtions" >
           <hr class="mb-5 text-white"/>
           <div class="container my-5">
              <div class="row">
                 <div class="col-md-12">
                    <h2 class="text-body-emphasis text-center py-5">Guardian Track by Cover Results</h2>
                 </div>
                 <div class="col-md-3">
                 </div>
                 <div class="container">
                    <div class="row justify-content-md-center row-cols-2 row-cols-lg-4 g-2 g-lg-4">
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/time.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Real-time tracking</h3>
                             <p class="my-4">GPS+Beidou+WiFi+LBS hybrid tracking, you can check the real-time and accurate position of the terminal at any time, and use different icons to mark different roles.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/historial-track.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Timing tracking</h3>
                             <p class="my-4">The terminal can automatically upload location information according to the set interval.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/trace.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Historical track</h3>
                             <p class="my-4">You can query the historical track of the terminal at any time.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/outrange.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Virtual fence</h3>
                             <p class="my-4">Any area can be set as a virtual fence, and a period of time can be added to the fence. Once the terminal enters and exits the fence during this period, the system immediately alarms</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="../assets/dist/img/notification.svg {{ asset('') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Message receiving</h3>
                             <p class="my-4">The terminal can receive messages and setting instructions pushed by the platform.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/alarm.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Anti-tampering alarm</h3>
                             <p class="my-4">The strap has a built-in conduction circuit, once it is removed, the system will alarm immediately.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/heart-rate.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Heart rate</h3>
                             <p class="my-4">Built-in heart rate sensor, you can monitor vital signs data at any time.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/sensor.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Motion sensor</h3>
                             <p class="my-4">Built-in motion sensor, you can monitor the wearer’s daily step count at any time.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="{{ asset('assets/dist/img/low-battery.svg') }}"/>
                             <h3 class="text-body-emphasis text-center my-3">Low power alarm</h3>
                             <p class="my-4">When the terminal power is less than 20%, a low power alarm is generated.</p>
                          </div>
                       </div>
                       <div class="col equal">
                          <div class="funtion-item-card">
                             <img class="img-fluid p-3 align-items-center" height="120px" src="../assets/dist/img/update.svg"/>
                             <h3 class="text-body-emphasis text-center my-3">Remote upgrade</h3>
                             <p class="my-4">Yes.</p>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="container-fluid backpage2 mx-auto" id="specs">
           <hr class="mb-5 text-white"/>
           <div class="container my-5">
              <div class="row">
                 <div class="col-md-12">
                    <h2 class="text-center p-5">Specifications</h2>
                    <div class="table-container">
                       <table class="table table-striped table-responsive">
                          <tbody>
                             <tr>
                                <td valign="middle">
                                   <h3>Name</h3>
                                </td>
                                <td valign="middle">
                                   <h3>Parameter</h3>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Model</h4>
                                </td>
                                <td valign="middle">
                                   <p>DDX04/T</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Tracking method</h4>
                                </td>
                                <td valign="middle">
                                   <p>GPS/Beidou/WIFI/LBS hybrid tracking</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Tracking accuracy</h4>
                                </td>
                                <td valign="middle">
                                   <p>&lt;10m (This data is for reference only, the tracking error is related to the terrain and environment of the terminal area)</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Communications network</h4>
                                </td>
                                <td valign="middle">
                                   <p>2G/3G/4G wireless network</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Display screen</h4>
                                </td>
                                <td valign="middle">
                                   <p>1.3 inch color screen, can display signal, power, date, week, time, ID, message, etc.</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Operation buttons</h4>
                                </td>
                                <td valign="middle">
                                   <p>Yes</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Built-in battery</h4>
                                </td>
                                <td valign="middle">
                                   <p>Built-in rechargeable 800mAh polymer lithium ion battery</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Charging method</h4>
                                </td>
                                <td valign="middle">
                                   <p>The buckle type wireless special charger, first fully charge the buckle type mobile power, and then buckle the mobile power to the watch to charge the watch. When charging, there is no need to connect the power cord, the wearer can walk freely</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Voltage</h4>
                                </td>
                                <td valign="middle">
                                   <p>DC 5V</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Charging time</h4>
                                </td>
                                <td valign="middle">
                                   <p>2 hours</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Standby time</h4>
                                </td>
                                <td valign="middle">
                                   <p>5 days standby time (tracking once per hour)</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Material</h4>
                                </td>
                                <td valign="middle">
                                   <p>Environmentally Friendly Plastic</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Size</h4>
                                </td>
                                <td valign="middle">
                                   <p>50*40*16mm (length, width and height)</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Weight</h4>
                                </td>
                                <td valign="middle">
                                   <p>About 64g</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Waterproof and dustproof</h4>
                                </td>
                                <td valign="middle">
                                   <p>IP68 level</p>
                                </td>
                             </tr>
                             <tr>
                                <td valign="middle">
                                   <h4>Working environment</h4>
                                </td>
                                <td valign="middle">
                                   <p>Working temperature: -30℃～+60℃; Working humidity: 10%～90%RH, no condensation</p>
                                </td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div id="contact">
           <hr class="mb-5 text-white"/>
           <div class="container-fluid">
              <div class="row align-items-center">
                 <div class="col-md-6 p-0">
                    <img class="img-fluid img-contact" src="{{ asset('assets/dist/img/contact.png') }}"/>
                 </div>
                 <div class="col-md-4 align-items-center">
                    <h2 class="text-body-emphasis px-5 my-5">Contact</h2>
                    <div class="px-5 my-5">
                       <form id="contactForm">
                          <div class="form-floating mb-3">
                             <input class="form-control" id="name" type="text" placeholder="Name" data-sb-validations="required" />
                             <label for="name">Name</label>
                             <div class="invalid-feedback" data-sb-feedback="name:required">Name is required.</div>
                          </div>
                          <div class="form-floating mb-3">
                             <input class="form-control" id="mobile" type="text" placeholder="Mobile" data-sb-validations="required" />
                             <label for="mobile">Mobile</label>
                             <div class="invalid-feedback" data-sb-feedback="mobile:required">Mobile is required.</div>
                          </div>
                          <div class="form-floating mb-3">
                             <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                             <label for="emailAddress">Email Address</label>
                             <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                             <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                          </div>
                          <div class="form-floating mb-3">
                             <textarea class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
                             <label for="message">Message</label>
                             <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
                          </div>
                          <div class="d-none" id="submitSuccessMessage">
                             <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                             </div>
                          </div>
                          <div class="d-none" id="submitErrorMessage">
                             <div class="text-center text-danger mb-3">Error sending message!</div>
                          </div>
                          <div class="text-end">
                             <button class="btn btn-primary btn-lg disabled rounded-pill" id="submitButton" type="submit">Submit</button>
                          </div>
                       </form>
                    </div>
                    <script src="{{ asset('assets/dist/js/sb-forms-latest.js') }}"></script>
                 </div>
              </div>
           </div>
        </div>
     </main>


     <div class="bg-dark text-white">
        <div class="container">
           <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-3 py-5 my-5">
              <div class="col mb-3 text-center">
                 <a href="index.html" class="mb-3 link-body-emphasis text-decoration-none">
                 <img class="img-fluid" width="180px" src="{{ asset('assets/dist/img/logo-dark.svg') }}"/>
                 </a>
                 <p class="text-white">© 2024 Covert Results</p>
              </div>
              <div class="col mb-3 text-center">
                 <h5>COVERT RESULTS</h5>
                 <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">41 Peabody St. Nashville, TN 37210</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">(615) 861-1680</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">contact@covertresults.com</a></li>
                 </ul>
              </div>
              <div class="col mb-3 text-center">
                 <h5>MORE INFO</h5>
                 <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Terms</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Login</a></li>
                 </ul>
              </div>
           </footer>
        </div>
     </div>
     
     <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
     <script>
        document.addEventListener('scroll', function() {
            const links = document.querySelectorAll('a[href^="#"]');
        
            links.forEach(link => {
                const sectionId = link.getAttribute('href').substring(1);
                const section = document.getElementById(sectionId);
                const rect = section.getBoundingClientRect();
                
                if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
     </script>


    </body>
</html>
