
      @include('includes.auth_menu', ['currentRoute' => 'send.notification.form'])
      <main class="flex-shrink-0">
         <div class="container  mt-3">
            <div class="table-container">
                <h1>Send Notification</h1>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                <form action="{{ route('send.notification') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="suspect_id" class="form-label">Suspect</label>
                        <select class="form-select" id="suspect_id" name="suspect_id" required>
                            <option value="" selected disabled>Select a suspect</option>
                            @foreach($suspects as $suspect)
                                <option value="{{ $suspect->id }}">
                                    {{ $suspect->name }} - {{ $suspect->lastname }} - {{ $suspect->device ? $suspect->device->serial : 'No Device' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Notification</button>
                </form>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            
            <script>
                $(document).ready(function() {
                    $('#suspect_id').select2({
                        placeholder: "Select a suspect",
                        allowClear: true
                    });
                });
            </script>
         </div>
      </main>

    

    
   </body>
</html>
