@extends('layout.backend.app', [
    'title' => 'Pengelolaan Jemaat',
    'pageTitle' => 'Pengelolaan Jemaat',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="card-body">
    <div class="row">
        <!-- Berulang Tahun Minggu Ini -->
        <div class="col-md-6">
            <h3>Berulang Tahun Minggu Ini</h3>
            @if (!empty($birthdaysThisWeek))
                <ul>
                    @foreach ($birthdaysThisWeek as $birthday)
                        <li>{{ $birthday['nama'] }} - {{ $birthday['tanggal'] }}</li>
                    @endforeach
                </ul>
            @else
                <p>No Berulang Tahun Minggu Ini.</p>
            @endif
        </div>
        
        <!-- Grafik Distribusi Umur Jemaat -->
        <div class="col-md-6">
            <h3>Distribusi Umur Jemaat</h3>
            <canvas id="ageDistributionChart"></canvas>
        </div>
    </div>
    
    <br/>
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    // Grafik Distribusi Umur Jemaat
    var ctx = document.getElementById('ageDistributionChart').getContext('2d');
    var ageDistributionData = @json($ageDistribution);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ageDistributionData.labels,
            datasets: [{
                label: 'Jumlah Jemaat',
                data: ageDistributionData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush
