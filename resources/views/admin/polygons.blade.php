
      @include('includes.auth_menu', ['currentRoute' => 'polygons.index'])
      <main class="flex-shrink-0">
         <div class="container mt-3">
            <div class="table-container" style="overflow:auto;">
               <div class="mb-3">
                  <div class="container text-center">
                     <div class="row">
                        <div class="col-6 col-md-auto mb-3">
                           <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#newPolygonModal">
                              New +
                           </button>
                        </div>
                        <div class="col-md-4 ps-3 mb-3">
                            <form action="{{ route('polygons.index') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search..."
                                        aria-label="search" aria-describedby="button-addon2"
                                        value="{{ request('search') }}" />
                                    <button class="btn btn-primary" type="submit" id="button-addon2">
                                        <img class="img-fluid" width="20" src="{{ asset('assets/dist/img/search.svg') }}" />
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1 ps-3 my-1">
                           <h5><span class="badge text-bg-secondary rounded-pill">Total: {{ count($polygons) }}</span></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <table class="table table-striped table-responsive">
                  <thead class="sticky-top top-0">
                     <tr>
                        <td align="center"><strong>Num.</strong></td>
                        <td align="center"><strong>Name</strong></td>
                        <td align="center"><strong>Coordinates</strong></td>
                        <td align="center"><strong>Actions</strong></td>
                     </tr>
                  </thead>
                  <tbody id="table-body">
                     @foreach ($polygons as $index => $polygon)
                        <tr>
                           <td align="center">{{ $polygon->id }}</td>
                           <td align="center">{{ $polygon->name }}</td>
                           <td align="center">{{ Str::limit($polygon->coordinates, 50) }}</td>
                           <td align="center">
                              <div class="d-flex justify-content-center actions">
                                <a href="#" class="px-1 px-md-3 edit-polygon"
   data-polygon-coordinates="{{ json_encode($polygon->coordinates) }}"
   data-bs-toggle="modal"
   data-bs-target="#editPolygonModal"
   data-polygon-id="{{ $polygon->id }}"
   data-polygon-name="{{ $polygon->name }}">
   <img src="{{ asset('assets/dist/img/edit.svg') }}" alt="Edit">
</a>

                                 <a href="#" class="px-1 px-md-3 delete-polygon" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deletePolygonModal" 
                                    data-polygon-id="{{ $polygon->id }}">
                                    <img src="{{ asset('assets/dist/img/delete.svg') }}" alt="Delete">
                                 </a>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
               <div class="d-flex justify-content-center">
                  {{ $polygons->links() }}
               </div>
            </div>
         </div>
      </main>

      <!-- Modal para Crear Nuevo Polígono -->
      <div class="modal modal-lg fade" id="newPolygonModal" tabindex="-1" aria-labelledby="newPolygonModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="newPolygonModalLabel">New Polygon</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <form id="polygonForm">
                     @csrf
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-6 mb-3">
                                 <label for="polygonName" class="form-label">Name</label>
                                 <input type="text" class="form-control" id="polygonName" name="name" required>
                             </div>
                             <div class="col-md-12 mb-3">
                                 <label class="form-label">Coordinates</label>
                                 <div id="coordinatesContainer">
                                     <div class="input-group mb-3 coordinate-input">
                                         <input type="text" class="form-control lat-input" placeholder="Latitude" required>
                                         <input type="text" class="form-control lng-input" placeholder="Longitude" required>
                                         <button type="button" class="btn btn-danger remove-coordinate">Remove</button>
                                     </div>
                                 </div>
                                 <button type="button" class="btn btn-primary" id="addCoordinate">Add Coordinate</button>
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

     <div class="modal modal-lg fade" id="editPolygonModal" tabindex="-1" aria-labelledby="editPolygonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPolygonModalLabel">Edit Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPolygonForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editPolygonName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editPolygonName" name="name" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div id="editCoordinatesContainer"></div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="button" id="addCoordinateE" class="btn btn-primary mb-3">Add Coordinate</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
     
   
     
     

      <!-- Modal para Eliminar Polígono -->
      <div class="modal modal-lg fade" id="deletePolygonModal" tabindex="-1" aria-labelledby="deletePolygonModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5 text-danger" id="deletePolygonModalLabel">Delete Polygon</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body text-center">
                  <h6>Are you sure you want to delete this polygon?</h6>
               </div>
               <div class="modal-footer text-center">
                  <form id="deletePolygonForm" method="POST" action="">
                     @csrf
                     @method('DELETE')
                     <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-danger rounded-pill">Yes, continue</button>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
      <script>
         $(document).ready(function() {

            // Configurar el modal de eliminación con los datos del polígono seleccionado
            $('#deletePolygonModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var polygonId = button.data('polygon-id');

                // Actualizar la acción del formulario de eliminación
                var formAction = "{{ url('polygons') }}/" + polygonId; // Asumiendo que la ruta de eliminación sigue el formato RESTful
                $('#deletePolygonForm').attr('action', formAction);
                
            });
         });
      </script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const addCoordinateBtn = document.getElementById('addCoordinate');
    const coordinatesContainer = document.getElementById('coordinatesContainer');
    const polygonForm = document.getElementById('polygonForm');
    const newPolygonModal = new bootstrap.Modal(document.getElementById('newPolygonModal')); // Asegúrate de que el ID sea correcto

    addCoordinateBtn.addEventListener('click', function () {
        const coordinateInputGroup = document.createElement('div');
        coordinateInputGroup.className = 'input-group mb-3 coordinate-input';
        coordinateInputGroup.innerHTML = `
            <input type="text" class="form-control lat-input" placeholder="Latitude" required>
            <input type="text" class="form-control lng-input" placeholder="Longitude" required>
            <button type="button" class="btn btn-danger remove-coordinate">Remove</button>
        `;
        coordinatesContainer.appendChild(coordinateInputGroup);

        coordinateInputGroup.querySelector('.remove-coordinate').addEventListener('click', function () {
            coordinateInputGroup.remove();
        });
    });

    polygonForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const name = document.getElementById('polygonName').value;
        const coordinates = [];

        document.querySelectorAll('.coordinate-input').forEach(group => {
            const lat = group.querySelector('.lat-input').value;
            const lng = group.querySelector('.lng-input').value;
            coordinates.push({ lat: parseFloat(lat), lng: parseFloat(lng) });
        });

        const formData = new FormData();
        formData.append('name', name);
        formData.append('coordinates', JSON.stringify(coordinates));

        fetch('{{ route('polygons.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Polygon saved successfully',
                    timer: 3000,
                    showConfirmButton: false
                });
                // Clear the form or close the modal
                polygonForm.reset();
                coordinatesContainer.innerHTML = `
                    <div class="input-group mb-3 coordinate-input">
                        <input type="text" class="form-control lat-input" placeholder="Latitude" required>
                        <input type="text" class="form-control lng-input" placeholder="Longitude" required>
                        <button type="button" class="btn btn-danger remove-coordinate">Remove</button>
                    </div>
                `;
                newPolygonModal.hide(); // Oculta el modal
                // Limpia los overlays y la clase oscura
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style = '';
                window.location.reload();
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error saving polygon',
                timer: 3000,
                showConfirmButton: false
            });

            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error saving polygon',
            timer: 3000,
            showConfirmButton: false
        });

        });
    });
});


</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    const editPolygonModal = document.getElementById('editPolygonModal');
    const editPolygonForm = document.getElementById('editPolygonForm');
    const editCoordinatesContainer = document.getElementById('editCoordinatesContainer');
    const addCoordinateEButton = document.getElementById('addCoordinateE');
    const editPolygonBootstrapModal = new bootstrap.Modal(editPolygonModal); // Asegúrate de que el ID sea correcto

    $('#editPolygonModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const polygonId = button.data('polygon-id');
        const polygonName = button.data('polygon-name');
        const rawCoordinates = button.data('polygon-coordinates');

        document.getElementById('editPolygonName').value = polygonName;
        editPolygonForm.setAttribute('action', `{{ url('polygons') }}/${polygonId}`);

        try {
            const decodedCoordinates = rawCoordinates.replace(/&quot;/g, '"');
            const arrayCoord = JSON.parse(decodedCoordinates);
            const coordinatesArray = JSON.parse(arrayCoord);
            if (Array.isArray(coordinatesArray)) {
                editCoordinatesContainer.innerHTML = '';
                coordinatesArray.forEach(({ lat, lng }) => {
                    createCoordinateInputGroup(lat, lng);
                });
            } else {
                throw new Error('Coordinates are not in expected array format');
            }
        } catch (error) {
            console.error('Error parsing polygon coordinates:', error);
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error loading polygon coordinates',
            timer: 3000,
            showConfirmButton: false
        });

        }
    });

    addCoordinateEButton.addEventListener('click', function() {
        console.log('click...');
        createCoordinateInputGroup('', '');
    });

    function createCoordinateInputGroup(lat, lng) {
        console.log("Entro");
        const coordinateInputGroup = document.createElement('div');
        coordinateInputGroup.className = 'input-group mb-3 coordinate-input';
        coordinateInputGroup.innerHTML = `
            <input type="text" class="form-control lat-input" placeholder="Latitude" value="${lat}" required>
            <input type="text" class="form-control lng-input" placeholder="Longitude" value="${lng}" required>
            <button type="button" class="btn btn-danger remove-coordinate">Remove</button>
        `;
        editCoordinatesContainer.appendChild(coordinateInputGroup);

        coordinateInputGroup.querySelector('.remove-coordinate').addEventListener('click', function() {
            coordinateInputGroup.remove();
        });
    }

    editPolygonForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const coordinateInputs = editCoordinatesContainer.querySelectorAll('.coordinate-input');
        const coordinatesArray = Array.from(coordinateInputs).map(inputGroup => {
            return {
                lat: parseFloat(inputGroup.querySelector('.lat-input').value),
                lng: parseFloat(inputGroup.querySelector('.lng-input').value)
            };
        });
        const coordinatesJson = JSON.stringify(coordinatesArray);
        const coordinatesInput = document.createElement('input');
        coordinatesInput.type = 'hidden';
        coordinatesInput.name = 'coordinates';
        coordinatesInput.value = coordinatesJson;
        editPolygonForm.appendChild(coordinatesInput);

        // Enviar el formulario con fetch
        const formData = new FormData(editPolygonForm);
        fetch(editPolygonForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Polygon updated successfully',
                    timer: 3000,
                    showConfirmButton: false
                });
                            
                editPolygonBootstrapModal.hide(); // Oculta el modal
                // Limpia los overlays y la clase oscura
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style = '';
                window.location.reload();
                
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error updating polygon',
                timer: 3000,
                showConfirmButton: false
            });

            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error updating polygon',
            timer: 3000,
            showConfirmButton: false
        });

        });
    });
});




    </script>
    
    
    
    
    
    


   </body>
</html>
