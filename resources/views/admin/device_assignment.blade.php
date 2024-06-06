@include('includes.auth_menu', ['currentRoute' => 'device_assignment'])
<main class="flex-shrink-0">
    <div class="container">
       <div class="table-container" style="overflow:auto;">
          <div class="mb-3">
             <div class="container text-center" >
                <div class="row">
                   <div class="col-md-4 ps-3 mb-3" >
                      <div class="input-group mb-3">
                         <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="button-addon2"/>
                         <a class="btn btn-primary" type="button" id="button-addon2"><img class="img-fluid" width="20" src="{{ asset('assets/dist/img/search.svg') }}"/></a>
                      </div>
                   </div>
                   <div class="col-6 col-md-3 ps-3 mb-3">
                      <select class="form-select">
                         <option selected>State....</option>
                         <option value="1">One</option>
                         <option value="2">Two</option>
                         <option value="3">Three</option>
                      </select>
                   </div>
                   <div class="col-6 col-md-3 ps-3 mb-3">
                      <select class="form-select">
                         <option selected>Device....</option>
                         <option value="1">One</option>
                         <option value="2">Two</option>
                         <option value="3">Three</option>
                      </select>
                   </div>
                   <div class="col-md-1 ps-3  my-1">
                      <h5><span class="badge text-bg-secondary rounded-pill">Total: 18</span></h5>
                   </div>
                </div>
             </div>
             <!-- Modal -->
             <div class="modal modal-lg fade" id="newDeviceModal" tabindex="-1" aria-labelledby="newDeviceModalModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">New</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                         <div class="row align-items-center">
                            <div class="col-md-4 mb-3">
                               <div class="container">
                                  <div class="file-upload-wrapper text-center justify-content-center">
                                     <label for="customFile">
                                     <img src="{{ asset('assets/dist/img/upload.svg') }}" alt="Upload" class="file-upload-image" id="uploadImage">
                                     </label>
                                     <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                                     <label class="custom-file-label text-truncate align-items-center" style="max-width: 100%" for="customFile">Chose a photo...</label>
                                     <div class="clear-button" id="clearButton">Delete</div>
                                  </div>
                               </div>
                               <script>
                                  $(document).ready(function() {
                                      $('#customFile').on('change', function() {
                                          // Obtener el nombre del archivo
                                          var fileName = $(this).val().split('\\').pop();
                                          // Actualizar el label del input con el nombre del archivo y agregar "Cambiar"
                                          $(this).next('.custom-file-label').html(fileName);
                                          // Mostrar el botón de limpiar
                                          $('#clearButton').show();
                                  
                                          // Mostrar vista previa de la imagen
                                          var reader = new FileReader();
                                          reader.onload = function (e) {
                                              $('#uploadImage').attr('src', e.target.result);
                                          }
                                          reader.readAsDataURL(this.files[0]);
                                      });
                                  
                                      // Acción del botón limpiar
                                      $('#clearButton').on('click', function() {
                                          // Limpiar el input file
                                          $('#customFile').val('');
                                          // Resetear la imagen a la imagen de subida original
                                          $('#uploadImage').attr('src', '../assets/dist/img/upload.svg');
                                          // Resetear el label
                                          $('.custom-file-label').html('Elija un archivo...');
                                          // Ocultar el botón de limpiar
                                          $(this).hide();
                                      });
                                  });
                               </script>
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Name" class="form-label">Name</label>
                               <input class="form-control" type="text" placeholder="" aria-label="Name">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Last name" class="form-label">Last name</label>
                               <input class="form-control" type="text" placeholder="" aria-label="Last name">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="ID" class="form-label">ID</label>
                               <input class="form-control" type="text" placeholder="" aria-label="ID">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Date-of-birth" class="form-label">Date of birth</label>
                               <input class="form-control" type="text" placeholder="" aria-label="Date-of-birth">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="State" class="form-label">State</label>
                               <select class="form-select" aria-label="State">
                                  <option selected>Select....</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                               </select>
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="City" class="form-label">City</label>
                               <select class="form-select" aria-label="City">
                                  <option selected>Select....</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                               </select>
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Address" class="form-label">Address</label>
                               <input class="form-control" type="text" placeholder="" aria-label="Address">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Phone" class="form-label">Phone</label>
                               <input class="form-control" type="text" placeholder="" aria-label="Phone">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Mobile" class="form-label">Mobile</label>
                               <input class="form-control" type="text" placeholder="" aria-label="Mobile">
                            </div>
                            <div class="col-md-4 mb-3">
                               <label for="Email" class="form-label">Email</label>
                               <input class="form-control" type="email" placeholder="" aria-label="Email">
                            </div>
                            <div class="col-md-12 mb-3">
                               <h6>Device assignment</h6>
                               <hr>
                            </div>
                            <div class="col-md-12 mb-3">
                               <label for="divice" class="form-label">Divice</label>
                               <select class="form-select" aria-label="divice">
                                  <option selected>Select....</option>
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                               </select>
                            </div>
                         </div>
                      </div>
                      <div class="modal-footer">
                         <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                         <button type="button" class="btn btn-primary rounded-pill">Save</button>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <table class="table table-striped table-responsive">
             <thead class="sticky-top top-0">
                <tr>
                   <td class="table-border-right" align="center"><strong>Num.</strong></td>
                   <td align="center"><strong>Name</strong></td>
                   <td align="center"><strong>ID</strong></td>
                   <td align="center"><strong>Device serial</strong></td>
                   <td align="center"><strong>Last update</strong></td>
                   <td align="center"><strong>Age</strong></td>
                   <td align="center"><strong>State</strong></td>
                   <td align="center"><strong>Address</strong></td>
                   <td class="table-border-left" align="center"><strong>Actions</strong></td>
                </tr>
             </thead>
             <tbody id="table-body">
                <!-- Contenido de la tabla se generará dinámicamente -->
             </tbody>
          </table>
          <nav class="d-flex justify-content-end" aria-label="...">
             <ul class="pagination" id="pagination">
                <!-- Paginación se generará dinámicamente -->
             </ul>
          </nav>
       </div>
       <!-- jQuery -->
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
       <script>
          $(document).ready(function () {
              const data = [
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '<span class="text-danger">Unassigned</span>', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          { id: 1, name: 'Jhon Doe', socialid:'12341654564', deviceserial: '12345678910', lastupdate: '16 / 05 / 2024 - 17:30', age: '52', state: 'Tennesee', address:'2102 Sheridan Rd', actions: { show: '#showModal', edit: '#editModal', delete: '#deleteModal' } },
          
              ];
          
              const rowsPerPage = 10;
              let currentPage = 1;
          
              function displayTable(page) {
                  const start = (page - 1) * rowsPerPage;
                  const end = start + rowsPerPage;
                  const paginatedData = data.slice(start, end);
          
                  $('#table-body').empty();
                  paginatedData.forEach(item => {
                      const actionsHtml = Object.keys(item.actions).map(action => {
                          return `<img class="px-1 px-md-3" type="button" data-bs-toggle="modal" data-bs-target="${item.actions[action]}" src="../assets/dist/img/${action}.svg" alt="${action.charAt(0).toUpperCase() + action.slice(1)}"/>`;
                      }).join('');
          
                      $('#table-body').append(`
                          <tr>
                              <td class="table-border-right" align="center">${item.id}</td>
                              <td align="center">${item.name}</td>
                              <td align="center">${item.socialid}</td>
                              <td align="center">${item.deviceserial}</td>
          <td align="center">${item.lastupdate}</td>
                              <td align="center">${item.age}</td>
                              <td align="center">${item.state}</td>
          <td align="center">${item.address}</td>
                              <td class="table-border-left" align="center" width="100px">
                                  <div class="d-flex justify-content-center actions">
                                      ${actionsHtml}
          
                                  </div>
                              </td>
                          </tr>
                      `);
                  });
              }
          
              function displayPagination() {
                  const totalPages = Math.ceil(data.length / rowsPerPage);
                  $('#pagination').empty();
          
                  const prevDisabled = currentPage === 1 ? 'disabled' : '';
                  $('#pagination').append(`
                      <li class="page-item ${prevDisabled}">
                          <a class="page-link" href="#" id="prev">Previous</a>
                      </li>
                  `);
          
                  for (let i = 1; i <= totalPages; i++) {
                      $('#pagination').append(`
                          <li class="page-item ${i === currentPage ? 'active' : ''}">
                              <a class="page-link" href="#">${i}</a>
                          </li>
                      `);
                  }
          
                  const nextDisabled = currentPage === totalPages ? 'disabled' : '';
                  $('#pagination').append(`
                      <li class="page-item ${nextDisabled}">
                          <a class="page-link" href="#" id="next">Next</a>
                      </li>
                  `);
          
                  $('.page-link').on('click', function (event) {
                      event.preventDefault();
                      const page = $(this).text();
          
                      if (page === 'Previous' && currentPage > 1) {
                          currentPage--;
                      } else if (page === 'Next' && currentPage < totalPages) {
                          currentPage++;
                      } else if (!isNaN(page)) {
                          currentPage = parseInt(page);
                      }
          
                      displayTable(currentPage);
                      displayPagination();
                  });
              }
          
              displayTable(currentPage);
              displayPagination();
          });
       </script>
    </div>
    </div>
 </main>
 <div class="modal modal-lg fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Preview</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             ...
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
          </div>
       </div>
    </div>
 </div>
 <div class="modal modal-lg fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Edit device</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                   <div class="container">
                      <div class="file-upload-wrapper text-center justify-content-center">
                         <label for="customFile">
                         <img src="{{ asset('assets/dist/img/upload.svg') }}" alt="Upload" class="file-upload-image" id="uploadImage">
                         </label>
                         <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                         <label class="custom-file-label text-truncate align-items-center" style="max-width: 100%" for="customFile">Chose a photo...</label>
                         <div class="clear-button" id="clearButton">Delete</div>
                      </div>
                   </div>
                   <script>
                      $(document).ready(function() {
                          $('#customFile').on('change', function() {
                              // Obtener el nombre del archivo
                              var fileName = $(this).val().split('\\').pop();
                              // Actualizar el label del input con el nombre del archivo y agregar "Cambiar"
                              $(this).next('.custom-file-label').html(fileName);
                              // Mostrar el botón de limpiar
                              $('#clearButton').show();
                      
                              // Mostrar vista previa de la imagen
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                  $('#uploadImage').attr('src', e.target.result);
                              }
                              reader.readAsDataURL(this.files[0]);
                          });
                      
                          // Acción del botón limpiar
                          $('#clearButton').on('click', function() {
                              // Limpiar el input file
                              $('#customFile').val('');
                              // Resetear la imagen a la imagen de subida original
                              $('#uploadImage').attr('src', '../assets/dist/img/upload.svg');
                              // Resetear el label
                              $('.custom-file-label').html('Elija un archivo...');
                              // Ocultar el botón de limpiar
                              $(this).hide();
                          });
                      });
                   </script>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Name" class="form-label">Name</label>
                   <input class="form-control" type="text" placeholder="" aria-label="Name">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Last name" class="form-label">Last name</label>
                   <input class="form-control" type="text" placeholder="" aria-label="Last name">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="ID" class="form-label">ID</label>
                   <input class="form-control" type="text" placeholder="" aria-label="ID">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Date-of-birth" class="form-label">Date of birth</label>
                   <input class="form-control" type="text" placeholder="" aria-label="Date-of-birth">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="State" class="form-label">State</label>
                   <select class="form-select" aria-label="State">
                      <option selected>Select....</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                   </select>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="City" class="form-label">City</label>
                   <select class="form-select" aria-label="City">
                      <option selected>Select....</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                   </select>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Address" class="form-label">Address</label>
                   <input class="form-control" type="text" placeholder="" aria-label="Address">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Phone" class="form-label">Phone</label>
                   <input class="form-control" type="text" placeholder="" aria-label="Phone">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Mobile" class="form-label">Mobile</label>
                   <input class="form-control" type="text" placeholder="" aria-label="Mobile">
                </div>
                <div class="col-md-4 mb-3">
                   <label for="Email" class="form-label">Email</label>
                   <input class="form-control" type="email" placeholder="" aria-label="Email">
                </div>
                <div class="col-md-12 mb-3">
                   <h6>Device assignment</h6>
                   <hr>
                </div>
                <div class="col-md-12 mb-3">
                   <label for="divice" class="form-label">Divice</label>
                   <select class="form-select" aria-label="divice">
                      <option selected>Select....</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                   </select>
                </div>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-primary rounded-pill">Save</button>
          </div>
       </div>
    </div>
 </div>
 <div class="modal modal-lg fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Delete</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
             <h6>Are you sure you want to delete this device?</h6>
          </div>
          <div class="modal-footer text-center">
             <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-danger rounded-pill">Yes, continue</button>
          </div>
       </div>
    </div>
 </div>
</body>
<script>
 'use strict';
 
 ;( function ( document, window, index )
 {
 var inputs = document.querySelectorAll( '.inputfile' );
 Array.prototype.forEach.call( inputs, function( input )
 {
 var label	 = input.nextElementSibling,
 labelVal = label.innerHTML;
 
 input.addEventListener( 'change', function( e )
 {
 var fileName = '';
 if( this.files && this.files.length > 1 )
     fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
 else
     fileName = e.target.value.split( '\\' ).pop();
 
 if( fileName )
     label.querySelector( 'span' ).innerHTML = fileName;
 else
     label.innerHTML = labelVal;
 });
 });
 }( document, window, 0 ));
</script>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
</html>
