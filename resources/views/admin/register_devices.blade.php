@include('includes.auth_menu', ['currentRoute' => 'register_devices'])
<main class="flex-shrink-0">
    <div class="container">
       <div class="table-container">
          <div class="mb-3">
             <div class="container text-center">
                <div class="row">
                   <div class="col-6 col-md-auto mb-3"><button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#newDeviceModal">
                      New +
                      </button>
                   </div>
                   <div class="col-md-4 ps-3" >
                      {{-- <div class="input-group mb-3">
                         <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="button-addon2"/>
                         <a class="btn btn-primary" type="button" id="button-addon2"><img class="img-fluid" width="20" src="{{ asset('assets/dist/img/search.svg') }}"/></a>
                      </div> --}}
                      <form action="{{ route('devices.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="button-addon2" value="{{ request('search') }}"/>
                            <button class="btn btn-primary" type="submit" id="button-addon2"><img class="img-fluid" width="20" src="{{ asset('assets/dist/img/search.svg') }}"/></button>
                        </div>
                    </form>
                   </div>
                   <div class="col-md-1 ps-3  my-1">
                     <h5><span class="badge text-bg-secondary rounded-pill">Total: {{ $totalDevices }}</span></h5>
                   </div>
                </div>
             </div>
             <!-- Modal create -->
             <div class="modal modal-lg fade" id="newDeviceModal" tabindex="-1" aria-labelledby="newDeviceModalModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h1 class="modal-title fs-5" id="newDeviceModalModalLabel">Add New Device</h1>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <form action="{{ route('devices.store') }}" method="POST">
                           @csrf
                           <div class="modal-body">
                               <div class="row align-items-center">
                                   <div class="col-md-4 mb-3">
                                       <label for="name" class="form-label">Name</label>
                                       <input class="form-control" type="text" id="name" name="name" placeholder="Device Name" aria-label="Name" required>
                                   </div>
                                   <div class="col-md-4 mb-3">
                                       <label for="serial" class="form-label">Serial</label>
                                       <input class="form-control" type="text" id="serial" name="serial" placeholder="Device Serial" aria-label="Serial" required>
                                   </div>
                               </div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                               <button type="submit" class="btn btn-primary rounded-pill">Save</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
           
          </div>
          <table class="table table-striped table-responsive">
            <thead class="sticky-top top-0">
                <tr>
                    <td class="table-border-right" align="center"><strong>ID.</strong></td>
                    <td align="center"><strong>Name</strong></td>
                    <td align="center"><strong>Serial</strong></td>
                    <td align="center"><strong>Creation Date</strong></td>
                    <td class="table-border-left" align="center"><strong>Actions</strong></td>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($devices as $device)
                    <tr>
                        <td class="table-border-right" align="center">{{ $device->id }}</td>
                        <td align="center">{{ $device->name }}</td>
                        <td align="center">{{ $device->serial }}</td>
                        <td align="center">{{ $device->created_at->format('d / m / Y') }}</td>
                        <td class="table-border-left" align="center" width="100px">
                            <div class="d-flex justify-content-center actions">
                                <img class="px-1 px-md-3" type="button" data-bs-toggle="modal" data-bs-target="#showModal" src="../assets/dist/img/show.svg" alt="Show"/>
                                <img class="px-1 px-md-3" type="button" data-bs-toggle="modal" data-bs-target="#editModal" src="../assets/dist/img/edit.svg" alt="Edit"/>
                                <img class="px-1 px-md-3" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" src="../assets/dist/img/delete.svg" alt="Delete"/>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
         {{ $devices->links() }}
     </div>
        {{--   <table class="table table-striped table-responsive">
             <thead class="sticky-top top-0">
                <tr>
                   <td class="table-border-right" align="center"><strong>ID.</strong></td>
                   <td align="center"><strong>Name</strong></td>
                   <td align="center"><strong>Serial</strong></td>
                   <td align="center"><strong>Creation Date</strong></td>
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
          </nav> --}}
       </div>
       <!-- jQuery -->
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Device</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <!-- Formulario de Edición -->
               <form id="editDeviceForm" action="{{ route('devices.update', ['device' => $device->id]) }}" method="POST">
                   @csrf
                   @method('PUT')
                   <div class="mb-3">
                       <label for="name" class="form-label">Name</label>
                       <input type="text" class="form-control" id="name" name="name" value="{{ $device->name }}">
                   </div>
                   <div class="mb-3">
                       <label for="serial" class="form-label">Serial</label>
                       <input type="text" class="form-control" id="serial" name="serial" value="{{ $device->serial }}">
                   </div>
                   <!-- Otros campos de edición si es necesario -->
                   <button type="submit" class="btn btn-primary">Save Changes</button>
               </form>
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
