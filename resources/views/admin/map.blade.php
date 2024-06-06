
    @include('includes.auth_menu', ['currentRoute' => 'map'])
      <!-- Begin page content -->
      <main class="flex-shrink-0">
         <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg py-0" aria-label="Offcanvas navbar large">
               <button class="navbar-toggler id-search rounded-pill pb-1 bg-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
               <img class="p-2" src="{{ asset('assets/dist/img/search.svg') }}"/>
               </button>
               <div class="offcanvas offcanvas-end text-bg-ligh" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                  <div class="offcanvas-header">
                     <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                     <div class="d-flex flex-column flex-shrink-0 aside-search">
                        <div class="container-rounded mb-3">
                           <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                           <span class="fs-5 mb-1 fw-semibold">Alerts</span>
                           </a>
                           <ul class="nav nav-pills flex-column mb-auto">
                              <li class="nav-item">
                                 <a href="#" class="nav-link bg-danger d-flex text-white align-items-center justify-content-between mb-2">
                                 <img src="{{ asset('assets/dist/img/pulse.svg') }}"/>
                                 Pulseless <span class="badge bg-white text-danger">+99</span>
                                 <small>See all</small>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a href="#" class="nav-link bg-primary text-white align-items-center d-flex justify-content-between mb-2">
                                 <img src="{{ asset('assets/dist/img/location.svg') }}"/>
                                 Out of location <span class="badge bg-white text-primary">+99</span>
                                 <small>See all</small>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a href="#" class="nav-link bg-warning text-dark align-items-center d-flex justify-content-between mb-2">
                                 <img src="{{ asset('assets/dist/img/low-bat.svg') }}"/>
                                 Battery empty <span class="badge text-bg-dark">+99</span></span>
                                 <small>See all</small>
                                 </a>
                              </li>
                           </ul>
                        </div>
                        <div class="container-rounded">
                           <form>
                              <div class="mb-3">
                                 <span class="fs-5 mb-2 fw-semibold">Search</span>
                                 <input class="form-control" id="search" placeholder="Name...">
                              </div>
                              <div class="mb-3">
                                 <select class="form-select" aria-label="Default select example">
                                    <option selected>Select state</option>
                                    <option value="1">Tennessee</option>
                                    <option value="2">Nashville</option>
                                    <option value="3">Murfreesboro</option>
                                 </select>
                              </div>
                              <div class="col-12 mb-3">
                                 <button class="btn btn-primary" type="submit">Search <img src="{{ asset('assets/dist/img/search.svg') }}"/></button>
                              </div>
                           </form>
                           <div id="results">
                              <hr>
                              <span class="fs-5 fw-semibold">Results:</span>
                              <div style="height: 160px; overflow-y:auto;">
                                 <table class="table table-striped table-hover table-responsive">
                                    <thead class="sticky-top top-0">
                                       <tr>
                                          <td valign="middle">
                                             <strong>Name</strong>
                                          </td>
                                          <td valign="middle">
                                             <strong>ID</strong>
                                          </td>
                                       </tr>
                                    <thead>
                                    <tbody>
                                       <tr>
                                          <td valign="middle">
                                             <a class="nav nav-link" href="#">Jhon Doe</a>
                                          </td>
                                          <td valign="middle">
                                             <a class="nav nav-link" href="#">1017196607</a>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td valign="middle">
                                             <a class="nav nav-link" href="#">Jhon Doe</a>
                                          </td>
                                          <td valign="middle">
                                             <a class="nav nav-link" href="#">1017196607</a>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td valign="middle">
                                             <a class="nav nav-link" href="#">Jhon Doe</a>
                                          </td>
                                          <td valign="middle">
                                             <a class="nav nav-link" href="#">1017196607</a>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </nav>
            <img src="{{ asset('assets/dist/img/marker.svg') }}" class="marker" type="button" data-bs-toggle="collapse" data-bs-target="#details" aria-expanded="false" aria-controls="details"/>
            <div class="aside-search2 collapse" id="details">
               <div class="container-rounded">
                  <div class="text-center">
                     <img width="120px" src="{{ asset('assets/dist/img/photo.png') }}"/>
                  </div>
                  <ol class="list-group list-group-flush">
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div class="fw-bold">Name</div>
                           Jhon Doe
                        </div>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div class="fw-bold">Age</div>
                           52
                        </div>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div class="fw-bold">Date of birth</div>
                           18 / 11 / 1972
                        </div>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div class="fw-bold">Address</div>
                           2102 Sheridan Rd, Nashville, TN 37206
                        </div>
                     </li>
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div class="fw-bold">Case</div>
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vestibulum id odio at gravida.
                        </div>
                     </li>
                  </ol>
                  <div id="Alerts">
                     <hr>
                     <span class="fs-5 fw-semibold">Alerts:</span>
                     <div style="height: 130px; overflow-y:auto;">
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item">Out of location - 17:16 05 / 30 / 2024</li>
                           <li class="list-group-item">Out of location - 17:16 05 / 30 / 2024</li>
                           <li class="list-group-item">Out of location - 17:16 05 / 30 / 2024</li>
                           <li class="list-group-item">Out of location - 17:16 05 / 30 / 2024</li>
                           <li class="list-group-item">Out of location - 17:16 05 / 30 / 2024</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <iframe style="height:100vh;" width="100%"frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/">gps vehicle tracker</a></iframe>
         </div>
      </main>
   </body>
   <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
</html>
