@include('includes.auth_menu', ['currentRoute' => 'map'])

    <div class="container">
        <h1>Device details: {{ $device->name }}</h1> <div class="mb-3">
            <a href="{{ route('map') }}" class="btn btn-secondary">Back to Map</a>
        </div>

        <!-- Mapa para mostrar las ubicaciones -->
        <div id="map" style="height: 400px;"></div>

        <!-- Mostrar las alertas de los últimos 7 días -->
        <h3 class="mt-4">Alerts from the last week</h3>
        <ul>
            @foreach($alerts as $alert)
                <li>
                    {{ $alert->created_at->format('Y-m-d H:i:s') }} -
                    @if($alert->type =='out_of_location')
                    Disconnected
                    @elseif($alert->out_of_location)
                    Out of location
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mapOptions = {
                center: { lat: 40.563043, lng: -100.927030 }, // Puedes usar las coordenadas iniciales del dispositivo
                zoom: 10
            };

            let map = new google.maps.Map(document.getElementById('map'), mapOptions);
    let infowindow = new google.maps.InfoWindow();
    
    // Dibujar puntos en el mapa
    let consolidatedLocations = @json($consolidatedLocations);

    consolidatedLocations.forEach(function(location) {
        let marker = new google.maps.Marker({
            position: { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) },
            map: map
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent('Visited at: ' + location.time);
            infowindow.open(map, marker);
        });
    });

    // Mostrar alertas debajo del mapa
    let alerts = @json($alerts);
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.api_key') }}"></script>

