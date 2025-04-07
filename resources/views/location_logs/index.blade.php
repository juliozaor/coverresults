<!DOCTYPE html>
<html>
<head>
    <title>Location Logs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .modal-body {
            max-height: 400px; /* Ajusta esta altura según tus necesidades */
            overflow-y: auto;
        }
    </style>
</head>
<body>
    @include('includes.auth_menu', ['currentRoute' => 'location-logs.index'])
    <main class="flex-shrink-0">
        <div class="container mt-3">
            <div class="table-container" style="overflow:auto;">
                <div class="mb-3">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                            <div class="col-md-8 ps-3 mb-3">
                                    <form action="{{ route('location-logs.index') }}" method="GET" class="row">
                                        <div class="col-4">
                                            <label for="start_date" class="form-label mr-2">Suspect or device</label>
                                            <input type="text" name="search" class="form-control" placeholder="Suspect or device..." aria-label="search" aria-describedby="button-addon2" value="{{ request('search') }}" />
                                        </div>
                                        <div class="col-3">
                                            <label for="start_date" class="form-label mr-2">Start Date</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" />
                                        </div>
                                        <div class="col-3">
                                            <label for="end_date" class="form-label mr-2">End Date</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" />
                                        </div>
                                        <div class="col-2 mt-4">
                                            <button class="btn btn-primary" type="submit" id="button-addon2"><img class="img-fluid" width="20" src="{{ asset('assets/dist/img/search.svg') }}" /></button>
                                        </div>
                                    </form>
                                </div>
                            <div class="col-md-1 ps-3 my-1 mt-4">
                                <h5><span class="badge text-bg-secondary rounded-pill">Total: {{ $logs->total() }}</span></h5>
                            </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <a href="{{ route('location-logs.export', [
                                    'search' => request('search'),
                                    'start_date' => request('start_date'),
                                    'end_date' => request('end_date')
                                ]) }}" class="btn btn-success">Export to Excel</a>
                                

                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-responsive">
                    <thead class="sticky-top top-0">
                        <tr>
                            <td align="center"><strong>Num.</strong></td>
                            <td align="center"><strong>Suspect Name</strong></td>
                            <td align="center"><strong>Device Serial</strong></td>
                            <td align="center"><strong>Date</strong></td>
                            <td align="center"><strong>Locations</strong></td>
                            <td align="center"><strong>Actions</strong></td>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($logs as $index => $log)
                            <tr>
                                <td align="center">{{ $logs->firstItem() + $index }}</td>
                                <td align="center">{{ $log->suspect->name }} {{ $log->suspect->lastname }}</td>
                                <td align="center">{{ $log->device->serial }}</td>
                                <td align="center">{{ \Carbon\Carbon::parse($log->date)->format('Y-m-d') }}</td>
                                <td align="center">{{ json_encode($log->locations) }}</td>
                                <td align="center">
                                    <div class="d-flex justify-content-center actions">
                                        <a href="#" class="px-1 px-md-3 view-log" data-log-id="{{ $log->id }}" data-bs-toggle="modal" data-bs-target="#logModal">
                                            <img src="{{ asset('assets/dist/img/show.svg') }}" alt="Show">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Modal para Ver Log -->
    <div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logModalLabel">Log Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="logDetailsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="logDetails">
                            <!-- Details will be appended here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#logModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var logId = button.data('log-id');
                $.ajax({
                    url: `{{ url('location-logs') }}/${logId}`,
                    method: 'GET',
                    success: function(data) {
                        var locations = data.locations;
                        var logDetails = $('#logDetails');
                        logDetails.empty();
                        locations.forEach(function(location) {
                            logDetails.append('<tr><td>' + location.latitude + '</td><td>' + location.longitude + '</td><td>' + (location.time || 'N/A') + '</td></tr>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching log details:', textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
