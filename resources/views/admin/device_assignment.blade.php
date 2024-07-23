@include('includes.auth_menu', ['currentRoute' => 'suspects.index'])
<main class="flex-shrink-0">
    <div class="container">
        <div class="table-container" style="overflow:auto;">
            <div class="mb-3">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-6 col-md-auto mb-3"><button type="button" class="btn btn-primary rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#newSuspectModal">
                                New +
                            </button>
                        </div>
                        <div class="col-md-4 ps-3 mb-3">
                            <div class="input-group mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="search"
                                    aria-describedby="button-addon2" />
                                <a class="btn btn-primary" type="button" id="searchButton"><img class="img-fluid"
                                        width="20" src="{{ asset('assets/dist/img/search.svg') }}" /></a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 ps-3 mb-3">
                            <select class="form-select" id="stateFilter" name="stateFilter">
                                <option value="">State....</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-3 ps-3 mb-3">
                            <select class="form-select" id="cityFilter" name="cityFilter">
                                <option value="">City....</option>
                                <!-- Las ciudades se cargarán aquí -->
                            </select>
                        </div>
                        <div class="col-md-1 ps-3  my-1">
                            <h5><span class="badge text-bg-secondary rounded-pill">Total: <span id="total-count">{{ $suspects->total() }}</span></h5>

                        </div>
                    </div>
                </div>
                <!-- Modal create-->
                <div class="modal modal-lg fade" id="newSuspectModal" tabindex="-1"
                    aria-labelledby="newSuspectModalModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('suspects.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 mb-3">
                                            <div class="container">
                                                <div class="file-upload-wrapper text-center justify-content-center">
                                                    <label for="customFile">
                                                        <img src="{{ asset('assets/dist/img/upload.svg') }}"
                                                            alt="Upload" class="file-upload-image" id="uploadImage">
                                                    </label>
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                        name="photo" accept="image/*">
                                                    <label class="custom-file-label text-truncate align-items-center"
                                                        style="max-width: 100%" for="customFile">Choose a
                                                        photo...</label>
                                                    <div class="clear-button" id="clearButton">Delete</div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                placeholder="" aria-label="Name" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="lastname" class="form-label">Last name</label>
                                            <input class="form-control" id="lastname" name="lastname" type="text"
                                                placeholder="" aria-label="Last name" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="identification" class="form-label">ID</label>
                                            <input class="form-control" id="identification" name="identification"
                                                type="text" placeholder="" aria-label="ID" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="date_dirth" class="form-label">Date of birth</label>
                                            <input class="form-control" id="date_dirth" name="date_dirth"
                                                type="date" placeholder="" aria-label="Date-of-birth" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <select class="form-select" id="state" name="state" required>
                                                <option value="">select a state</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <select class="form-select" id="city" name="city" required>
                                                <option value="">select a city</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input class="form-control" id="address" name="address" type="text"
                                                placeholder="" aria-label="Address" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input class="form-control" id="phone" name="phone" type="text"
                                                placeholder="" aria-label="Phone">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="mobile" class="form-label">Mobile</label>
                                            <input class="form-control" id="mobile" name="mobile" type="text"
                                                placeholder="" aria-label="Mobile">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input class="form-control" id="email" name="email" type="email"
                                                placeholder="" aria-label="Email" required>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3">
                               <h6>Device assignment</h6>
                               <hr>
                            </div>
                             <div class="col-md-12 mb-3">
                               <label for="device_id" class="form-label">Device</label>
                               <select class="form-select" id="device_id" name="device_id">
                                 <option value="">Seleccione un dispositivo</option>
                                 @foreach ($devices as $device)
                                     <option value="{{ $device->id }}">{{ $device->name }}</option>
                                 @endforeach
                             </select>
                            </div> --}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary rounded-pill"
                                        data-bs-dismiss="modal">Cancel</button>
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
                        <td class="table-border-right" align="center"><strong>Num.</strong></td>
                        <td align="center"><strong>Name</strong></td>
                        <td align="center"><strong>ID</strong></td>
                        {{-- <td align="center"><strong>Device Serial</strong></td> --}}
                        <td align="center"><strong>Last Update</strong></td>
                        <td align="center"><strong>birthday</strong></td>
                        <td align="center"><strong>State</strong></td>
                        <td align="center"><strong>Address</strong></td>
                        <td class="table-border-left" align="center"><strong>Actions</strong></td>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($suspects as $index => $suspect)
                        <tr>
                            <td class="table-border-right" align="center">{{ $index + 1 }}</td>
                            <td align="center">{{ $suspect->name }}</td>
                            <td align="center">{{ $suspect->identification }}</td>
                          {{--   <td align="center">{{ $suspect->device->serial }}</td> --}}
                            <td align="center">{{ $suspect->updated_at }}</td>
                            <td align="center">{{ $suspect->date_dirth }}</td>
                            <td align="center">{{ $suspect->state }}</td>
                            <td align="center">{{ $suspect->address }}</td>
                            <td class="table-border-left" align="center">
                                <div class="d-flex justify-content-center actions">
                                    <a href="#" class="px-1 px-md-3 edit-suspect" type="button"
                                        data-bs-toggle="modal" data-bs-target="#editSuspectModal"
                                        data-suspect='@json($suspect)'>
                                        <img src="{{ asset('assets/dist/img/edit.svg') }}" alt="Edit">
                                    </a>


                                    <img class="px-1 px-md-3" type="button" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-suspect-id="{{ $suspect->id }}" 
                                        src="{{ asset('assets/dist/img/delete.svg') }}"
                                        alt="Delete" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $suspects->links() }}
            </div>
        </div>
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
                <button type="button" class="btn btn-outline-secondary rounded-pill"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para Editar -->
<div class="modal modal-lg fade" id="editSuspectModal" tabindex="-1" aria-labelledby="editSuspectModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editSuspectModalLabel">Edit Suspect</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editSuspectForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3">
                        <div class="container">
                            <div class="file-upload-wrapper text-center justify-content-center">
                                <label for="customFileEdit">
                                    <img src="{{ asset('assets/dist/img/upload.svg') }}" alt="Upload"
                                        class="file-upload-image" id="uploadImageEdit">
                                </label>
                                <input type="file" class="custom-file-input" id="customFileEdit"
                                    name="editPhoto" accept="image/*">
                                <label class="custom-file-label text-truncate align-items-center"
                                    style="max-width: 100%" for="customFileEdit">Choose a photo...</label>
                                <div class="clear-button" id="clearButtonEdit">Delete</div>
                            </div>
                        </div>
                    </div>
                    <input class="form-control" id="editId" name="editId" type="hidden">
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" id="editName" name="editName" type="text"
                            aria-label="Name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastname" class="form-label">Last name</label>
                        <input class="form-control" id="editLastname" name="editLastname" type="text"
                            aria-label="Last name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="identification" class="form-label">ID</label>
                        <input class="form-control" id="editIdentification" name="editIdentification"
                            type="text" aria-label="ID" required readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="date_dirth" class="form-label">Date of birth</label>
                        <input class="form-control" id="editDateDirth" name="editDateDirth" type="date"
                            aria-label="Date-of-birth" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="editState" class="form-label">State</label>
                        <select class="form-select" id="editState" name="editState" required>
                            <option value="">select a state</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="editCity" class="form-label">City</label>
                        <select class="form-select" id="editCity" name="editCity" required>
                            <option value="">select a city</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" id="editAddress" name="editAddress" type="text"
                            aria-label="Address" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input class="form-control" id="editPhone" name="editPhone" type="text"
                            aria-label="Phone">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input class="form-control" id="editMobile" name="editMobile" type="text"
                            aria-label="Mobile">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="editEmail" name="editEmail" type="email"
                            aria-label="Email" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill">Update</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal modal-lg fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h6>Are you sure you want to delete this suspect?</h6>
            </div>
            <div class="modal-footer text-center">
                <form id="deleteSuspectForm" method="POST" action="">
                   @csrf
                   @method('DELETE')
                   <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-danger rounded-pill">Yes, continue</button>
                </form>
             </div>
        </div>
    </div>
</div>
</body>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    'use strict';
    (function(document, window, index) {
        var inputs = document.querySelectorAll('.inputfile');
        Array.prototype.forEach.call(inputs, function(input) {
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener('change', function(e) {
                var fileName = '';
                if (this.files && this.files.length > 1)
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}',
                        this.files.length);
                else
                    fileName = e.target.value.split('\\').pop();

                if (fileName)
                    label.querySelector('span').innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });
        });
    }(document, window, 0));
</script>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
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
            reader.onload = function(e) {
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
<script>
    $(document).ready(function() {
        $('#customFileEdit').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
            $('#clearButtonEdit').show();

            var reader = new FileReader();
            reader.onload = function(e) {
                $('#uploadImageEdit').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#clearButtonEdit').on('click', function() {
            $('#customFileEdit').val('');
            $('#uploadImageEdit').attr('src', '{{ asset('assets/dist/img/upload.svg') }}');
            $('.custom-file-label').html('Choose a photo...');
            $(this).hide();
        });

        $('#editSuspectModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var suspectData = button.data('suspect'); // Extraer datos del atributo data-* del botón

    // Llenar los campos del formulario con los datos del sospechoso
    $('#editName').val(suspectData.name);
    $('#editLastname').val(suspectData.lastname);
    $('#editIdentification').val(suspectData.identification);
    $('#editDateDirth').val(suspectData.date_dirth);
    $('#editState').val(suspectData.state);
    $('#editCity').val(suspectData.city);
    $('#editAddress').val(suspectData.address);
    $('#editPhone').val(suspectData.phone);
    $('#editMobile').val(suspectData.mobile);
    $('#editEmail').val(suspectData.email);
    $('#editId').val(suspectData.id);

    // Actualizar la acción del formulario con el ID correcto
    $('#editSuspectForm').attr('action', '{{ url('suspects') }}/' + suspectData.id);

    // Mostrar la imagen actual
    if (suspectData.photo) {
        $('#uploadImageEdit').attr('src', '{{ asset('storage') }}/' + suspectData.photo);
    } else {
        $('#uploadImageEdit').attr('src', '{{ asset('assets/dist/img/upload.svg') }}');
    }

    // Actualizar el label del archivo
    if (suspectData.photo) {
        var fileName = suspectData.photo.split('/').pop();
        $('.custom-file-label').html(fileName);
        $('#clearButtonEdit').show();
    } else {
        $('.custom-file-label').html('Choose a photo...');
        $('#clearButtonEdit').hide();
    }
});

        // Filtrar ciudades según el estado seleccionado
        $('#state, #stateFilter').change(function() {
        var stateId = $(this).val();
        var citySelect = $(this).attr('id') === 'stateFilter' ? $('#cityFilter') : $('#city');
        
        // Limpiar el campo de selección de ciudad
        citySelect.empty();
        citySelect.append('<option value="">select a city</option>');
        
        if (stateId) {
            $.ajax({
                url: `{{ url('get-cities') }}/${stateId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        citySelect.append(`<option value="${value.id}">${value.name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching cities:', error);
                }
            });
        }
    });

    // Función de búsqueda
    function fetchSuspects(query = '', state = '', city = '') {
        $.ajax({
            url: `{{ route('suspects.index') }}`,
            type: 'GET',
            data: {
                query: query,
                state: state,
                city: city
            },
            success: function(data) {
                $('#table-body').html(data.html);
                $('#total-count').text(data.total);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching suspects:', xhr.responseText);
            }
        });
    }

    $('#searchButton').click(function() {
        var query = $('#searchInput').val();
        var state = $('#stateFilter').val();
        var city = $('#cityFilter').val();
        fetchSuspects(query, state, city);
    });

    $('#stateFilter, #cityFilter').change(function() {
        var query = $('#searchInput').val();
        var state = $('#stateFilter').val();
        var city = $('#cityFilter').val();
        fetchSuspects(query, state, city);
    });


    });

    $('#editState').change(function() {
            var stateId = $(this).val();
            var citySelect = $('#editCity');
            
            // Limpiar el campo de selección de ciudad
            citySelect.empty();
            citySelect.append('<option value="">select a city</option>');
            
            if (stateId) {
                $.ajax({
                    url: `{{ url('get-cities') }}/${stateId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {
                            citySelect.append(`<option value="${value.id}">${value.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cities:', error);
                    }
                });
            }
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var suspectId = button.data('suspect-id');

                // Actualizar la acción del formulario de eliminación
                var formAction = "{{ url('suspects') }}/" + suspectId; // Asumiendo que la ruta de eliminación sigue el formato RESTful
                $('#deleteSuspectForm').attr('action', formAction);
                
            });




</script>

</html>
