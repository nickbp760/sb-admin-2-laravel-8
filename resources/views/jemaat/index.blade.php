@extends('layout.backend.app', [
    'title' => 'Manage Jemaat',
    'pageTitle' => 'Manage Jemaat',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="card-body">
    <a href="{{ route('jemaat.tambah') }}" class="btn btn-info">Input Jemaat Baru</a>
    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped display nowrap" style="width:100%" id="dataTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>OPSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jemaat as $e)
                <tr>
                    <td>{{ $e->id }}</td>             
                    <td>{{ $e->nama }}</td>
                    <td>{{ $e->alamat }}</td>          
                    <td>
                        <a href="{{ route('jemaat.edit', $e->id) }}" class="btn btn-primary">Edit</a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $e->id }}">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Benar-Benar Ingin Menghapus Item Ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Ya Hapus</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->

@endsection

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var deleteUrl = '';

    // Handle delete button click
    $('body').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        deleteUrl = '{{ route("jemaat.delete", ":id") }}'.replace(':id', id);
        $('#delete-modal').modal('show');
    });

    // Confirm delete action
    $('#confirm-delete').on('click', function() {
        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            success: function(response) {
                $('#delete-modal').modal('hide');
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                $('#delete-modal').modal('hide');
            }
        });
    });
});
</script>
@endpush
