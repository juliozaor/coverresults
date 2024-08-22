@foreach ($suspects as $index => $suspect)
    <tr>
        <td class="table-border-right" align="center">{{ $index + 1 }}</td>
        <td align="center">{{ $suspect->name }}</td>
        <td align="center">{{ $suspect->lastname }}</td>
        <td align="center">{{ $suspect->identification }}</td>        
        <td align="center">{{ $suspect->updated_at }}</td>
        <td align="center">{{ $suspect->date_dirth }}</td>
        <td align="center">{{ $suspect->states->name }}</td>
        <td align="center">{{ $suspect->address }}</td>
        <td align="center">{{ $suspect->device->serial ?? '' }}</td>
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
