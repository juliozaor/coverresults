@include('includes.auth_menu', ['currentRoute' => 'map'])
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg py-0" aria-label="Offcanvas navbar large">
            <button class="navbar-toggler id-search rounded-pill pb-1 bg-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
                <img class="p-2" src="{{ asset('assets/dist/img/search.svg') }}"/>
            </button>
            <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
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
                                        Pulseless <span class="badge bg-white text-danger" id="pulseless-count">{{ $pulselessCount }}</span>
                                        <small>See all</small>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link bg-primary text-white align-items-center d-flex justify-content-between mb-2">
                                        <img src="{{ asset('assets/dist/img/location.svg') }}"/>
                                        Out of location <span class="badge bg-white text-primary" id="out-of-location-count">{{ $outOfLocationCount }}</span>
                                        <small>See all</small>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link bg-warning text-dark align-items-center d-flex justify-content-between mb-2">
                                        <img src="{{ asset('assets/dist/img/low-bat.svg') }}"/>
                                        Battery empty <span class="badge text-bg-dark" id="battery-empty-count">{{ $batteryEmptyCount }}</span>
                                        <small>See all</small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="container-rounded">
                            <form id="searchForm">
                                <div class="mb-3">
                                    <span class="fs-5 mb-2 fw-semibold">Search</span>
                                    <input class="form-control" id="search" placeholder="Name or ID...">
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
                                        <tbody id="resultsBody">
                                            <!-- Initial results will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div id="map"></div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mapOptions = {
                center: { lat: 6.2442, lng: -75.5812 }, // Centro de Medellín
                zoom: 14
            };

            let map = new google.maps.Map(document.getElementById('map'), mapOptions);
            let markers = {};
            let infowindow = new google.maps.InfoWindow();
            let polygons = @json($polygons);
            let devices = @json($devices);

            console.log(devices);

            // Dibujar polígonos en el mapa
            polygons.forEach(function(polygon) {
                let polygonCoords = polygon.coordinates.map(function(coord) {
                    return { lat: parseFloat(coord.lat), lng: parseFloat(coord.lng) };
                });

                let googlePolygon = new google.maps.Polygon({
                    paths: polygonCoords,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });

                googlePolygon.setMap(map);
            });

            // Función para actualizar los contadores de alertas
            function updateAlertCounts() {
                $.get("{{ url('api/alerts/counts') }}", function(data) {
                    $('#pulseless-count').text(data.pulseless);
                    $('#out-of-location-count').text(data.out_of_location);
                    $('#battery-empty-count').text(data.battery_empty);
                });
            }

            // Actualizar los contadores de alertas cada 5 segundos
            setInterval(updateAlertCounts, 5000);

            // Función para cargar los dispositivos y sus marcadores
            function loadMarkers(devices) {
                devices.forEach(device => {
                    if (!markers[device.id]) {
                        let marker = new google.maps.Marker({
                            position: { lat: parseFloat(device.latitude), lng: parseFloat(device.longitude) },
                            map: map,
                            title: device.name
                        });
                        markers[device.id] = marker;

                        google.maps.event.addListener(marker, 'mouseover', function() {
                            let suspect = device.suspect || {};
                            let contentString = `
                                <div class="info-window">
                                    <img width="120px" src="${device.photo_url || '{{ asset('assets/dist/img/upload.svg') }}'}"/>
                                    <ol class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Name</div>
                                                ${suspect.name ? suspect.name + ' ' + suspect.lastname : 'No suspect'}
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">ID</div>
                                                ${suspect.identification || 'N/A'}
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Date of birth</div>
                                                ${suspect.date_dirth || 'N/A'}
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Address</div>
                                                ${suspect.address || 'N/A'}
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            `;
                            infowindow.setContent(contentString);
                            infowindow.open(map, marker);
                        });

                        google.maps.event.addListener(marker, 'mouseout', function() {
                            infowindow.close();
                        });
                    }
                });
            }

            // Función para mostrar los resultados en la tabla
            function showResults(devices) {
                const resultsBody = document.getElementById('resultsBody');
                resultsBody.innerHTML = '';

                devices.forEach(device => {
                    if (device.suspect) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td valign="middle">
                                <a class="nav nav-link" href="#" onclick="centerMap(${device.latitude}, ${device.longitude})">${device.suspect.name} ${device.suspect.lastname}</a>
                            </td>
                            <td valign="middle">
                                <a class="nav nav-link" href="#" onclick="centerMap(${device.latitude}, ${device.longitude})">${device.suspect.identification}</a>
                            </td>
                        `;
                        resultsBody.appendChild(row);
                    }
                });
            }

            // Cargar todos los dispositivos inicialmente
            loadMarkers(devices);
            showResults(devices);

            // Manejar la búsqueda de sospechosos
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const query = document.getElementById('search').value;

                fetch(`{{ url('search-suspects') }}?query=${query}`)
                    .then(response => response.json())
                    .then(filteredDevices => {
                        // Mostrar los resultados filtrados
                        showResults(filteredDevices);
                    });
            });

            // Función para centrar el mapa en un marcador específico
            window.centerMap = function(lat, lng) {
                map.setCenter({ lat, lng });
                map.setZoom(15);
            };
        });
        </script>
    </div>
</main>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.api_key') }}&libraries=drawing"></script>
</html>
