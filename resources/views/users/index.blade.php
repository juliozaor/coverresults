@include('includes.auth_menu', ['currentRoute' => 'users.index'])

<main class="flex-shrink-0">
    <div class="container mt-3">
        <div class="table-container" style="overflow:auto;">
            <div class="mb-3">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-6 col-md-auto mb-3">
                            <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#newUserModal">
                                New +
                            </button>
                        </div>
                        <div class="col-md-4 ps-3 mb-3">
                            <div class="input-group mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="button-addon2" />
                                <a class="btn btn-primary" type="button" id="searchButton"><img class="img-fluid" width="20" src="{{ asset('assets/dist/img/search.svg') }}" /></a>
                            </div>
                        </div>
                        <div class="col-md-1 ps-3 my-1">
                            <h5><span class="badge text-bg-secondary rounded-pill">Total: {{ $users->total() }}</span></h5>
                        </div>
                    </div>
                </div>
                <!-- Modal create -->
                <div class="modal modal-lg fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input class="form-control" id="email" name="email" type="email" required>
                                        </div>
                                       {{--  <div class="col-md-4 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control" id="password" name="password" type="password" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required>
                                        </div> --}}
                                        <div class="col-md-4 mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-select" id="role" name="role" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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
                        <td align="center"><strong>Num.</strong></td>
                        <td align="center"><strong>Name</strong></td>
                        <td align="center"><strong>Email</strong></td>
                        <td align="center"><strong>Role</strong></td>
                        <td align="center"><strong>Actions</strong></td>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($users as $index => $user)
                        <tr>
                            <td align="center">{{ $index + 1 }}</td>
                            <td align="center">{{ $user->name }}</td>
                            <td align="center">{{ $user->email }}</td>
                            <td align="center">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                            <td align="center">
                                <div class="d-flex justify-content-center actions">
                                    <a href="#" class="px-1 px-md-3 edit-user" type="button" data-bs-toggle="modal" data-bs-target="#editUserModal" data-user='@json($user)'>
                                        <img src="{{ asset('assets/dist/img/edit.svg') }}" alt="Edit">
                                    </a>
                                    <img class="px-1 px-md-3" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-user-id="{{ $user->id }}" src="{{ asset('assets/dist/img/delete.svg') }}" alt="Delete" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</main>

<!-- Modal para Editar -->
<div class="modal modal-lg fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editUserModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row align-items-center">
                        <input class="form-control" id="editId" name="editId" type="hidden">
                        <div class="col-md-4 mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input class="form-control" id="editName" name="editName" type="text" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input class="form-control" id="editEmail" name="editEmail" type="email" required>
                        </div>
                        {{-- <div class="col-md-4 mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input class="form-control" id="editPassword" name="editPassword" type="password">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="editPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input class="form-control" id="editPasswordConfirmation" name="editPasswordConfirmation" type="password">
                        </div> --}}
                        <div class="col-md-4 mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" name="editRole" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
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

<div class="modal modal-lg fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="deleteModalLabel">Delete User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h6>Are you sure you want to delete this user?</h6>
            </div>
            <div class="modal-footer text-center">
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill">Yes, continue</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#editUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var userData = button.data('user');

            $('#editId').val(userData.id);
            $('#editName').val(userData.name);
            $('#editEmail').val(userData.email);
            $('#editRole').val(userData.roles[0].name);

            $('#editUserForm').attr('action', '{{ url('users') }}/' + userData.id);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var userId = button.data('user-id');
            $('#deleteUserForm').attr('action', '{{ url('users') }}/' + userId);
        });
    });
</script>

