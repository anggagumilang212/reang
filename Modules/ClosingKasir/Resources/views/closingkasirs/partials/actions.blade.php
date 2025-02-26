@can('show_closingkasir')
    <a href="{{ route('closing-kasir.show', $data->tanggal) }}" class="btn btn-primary btn-sm">
        <i class="bi bi-eye"></i>
    </a>
@endcan
@can('delete_closingkasir')
    <button id="delete" class="btn btn-danger btn-sm"
        onclick="
    event.preventDefault();
    if (confirm('Are you sure? It will delete the data permanently!')) {
        document.getElementById('destroy{{ $data->id }}').submit()
    }
    ">
        <i class="bi bi-trash"></i>
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('closingkasir.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
