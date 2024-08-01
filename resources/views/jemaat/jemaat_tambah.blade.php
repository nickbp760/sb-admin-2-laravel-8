@extends('layout.backend.app',[
    'title' => 'Manage Jemaat',
    'pageTitle' =>'Manage Jemaat',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="card-body">
    <a href="/jemaat" class="btn btn-primary">Kembali</a>
    <br/>
    <br/>
    
    <form method="post" action="/jemaat/store">

        {{ csrf_field() }}

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama jemaat ..">

            @if($errors->has('nama'))
                <div class="text-danger">
                    {{ $errors->first('nama')}}
                </div>
            @endif

        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Alamat jemaat .."></textarea>

                @if($errors->has('alamat'))
                <div class="text-danger">
                    {{ $errors->first('alamat')}}
                </div>
            @endif

        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Simpan">
        </div>

    </form>

</div>
@endsection