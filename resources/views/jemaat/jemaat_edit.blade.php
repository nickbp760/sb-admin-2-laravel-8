@extends('layout.backend.app', [
    'title' => 'Manage Jemaat',
    'pageTitle' => 'Edit Jemaat',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="card-body">
    <a href="/jemaat" class="btn btn-primary">Kembali</a>
    <br/>
    <br/>
    
    <form method="post" action="/jemaat/update/{{ $jemaat->id }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama jemaat .." value="{{ old('nama', $jemaat->nama) }}">
            @if($errors->has('nama'))
                <div class="text-danger">
                    {{ $errors->first('nama') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Alamat jemaat ..">{{ old('alamat', $jemaat->alamat) }}</textarea>
            @if($errors->has('alamat'))
                <div class="text-danger">
                    {{ $errors->first('alamat') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @if($errors->has('jenis_kelamin'))
                <div class="text-danger">
                    {{ $errors->first('jenis_kelamin') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $jemaat->tanggal_lahir ? $jemaat->tanggal_lahir->format('Y-m-d') : '') }}">
            @if($errors->has('tanggal_lahir'))
                <div class="text-danger">
                    {{ $errors->first('tanggal_lahir') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Kota</label>
            <select name="kota" class="form-control">
                <option value="">Pilih Kota Anda</option>
                <option value="Surabaya" {{ old('kota', $jemaat->kota) == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                <option value="Gresik" {{ old('kota', $jemaat->kota) == 'Gresik' ? 'selected' : '' }}>Gresik</option>
                <option value="Sidoarjo" {{ old('kota', $jemaat->kota) == 'Sidoarjo' ? 'selected' : '' }}>Sidoarjo</option>
                <option value="Kediri" {{ old('kota', $jemaat->kota) == 'Kediri' ? 'selected' : '' }}>Kediri</option>
            </select>
            @if($errors->has('kota'))
                <div class="text-danger">
                    {{ $errors->first('kota') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos .." value="{{ old('kode_pos', $jemaat->kode_pos) }}">
            @if($errors->has('kode_pos'))
                <div class="text-danger">
                    {{ $errors->first('kode_pos') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon .." value="{{ old('nomor_telepon', $jemaat->nomor_telepon) }}">
            @if($errors->has('nomor_telepon'))
                <div class="text-danger">
                    {{ $errors->first('nomor_telepon') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email .." value="{{ old('email', $jemaat->email) }}">
            @if($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Status Baptisan</label>
            <select name="status_baptisan" class="form-control">
                <option value="">Pilih Status Baptisan</option>
                <option value="Sudah" {{ old('status_baptisan', $jemaat->status_baptisan) == 'Sudah' ? 'selected' : '' }}>Sudah</option>
                <option value="Belum" {{ old('status_baptisan', $jemaat->status_baptisan) == 'Belum' ? 'selected' : '' }}>Belum</option>
            </select>
            @if($errors->has('status_baptisan'))
                <div class="text-danger">
                    {{ $errors->first('status_baptisan') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Tanggal Baptisan</label>
            <input type="date" name="tanggal_baptisan" class="form-control" value="{{ old('tanggal_baptisan', $jemaat->tanggal_baptisan ? $jemaat->tanggal_baptisan->format('Y-m-d') : '') }}">
            @if($errors->has('tanggal_baptisan'))
                <div class="text-danger">
                    {{ $errors->first('tanggal_baptisan') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Status Anggota</label>
            <select name="status_anggota" class="form-control">
                <option value="">Pilih Status Anggota</option>
                <option value="Jemaat Umum" {{ old('status_anggota', $jemaat->status_anggota) == 'Jemaat Umum' ? 'selected' : '' }}>Jemaat Umum</option>
                <option value="Anggota Aktif" {{ old('status_anggota', $jemaat->status_anggota) == 'Anggota Aktif' ? 'selected' : '' }}>Anggota Aktif</option>
                <option value="Tamu" {{ old('status_anggota', $jemaat->status_anggota) == 'Tamu' ? 'selected' : '' }}>Tamu</option>
            </select>
            @if($errors->has('status_anggota'))
                <div class="text-danger">
                    {{ $errors->first('status_anggota') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Waktu Bergabung</label>
            <input type="date" name="waktu_bergabung" class="form-control" value="{{ old('waktu_bergabung', $jemaat->waktu_bergabung ? $jemaat->waktu_bergabung->format('Y-m-d') : '') }}">
            @if($errors->has('waktu_bergabung'))
                <div class="text-danger">
                    {{ $errors->first('waktu_bergabung') }}
                </div>
            @endif
        </div>

    <!-- New Photo Upload Field -->
    <div class="form-group">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
        @if($errors->has('foto'))
            <div class="text-danger">
                {{ $errors->first('foto') }}
            </div>
        @endif
        <!-- Display existing photo if available -->
        @if($jemaat->foto)
            <div class="mt-2">
            <img src="{{ str_replace('public/', '', asset('storage/' . $jemaat->foto)) }}" alt="Foto Jemaat" class="img-thumbnail" style="max-height: 200px;">
            </div>
        @endif
    </div>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Simpan">
        </div>

    </form>

</div>
@endsection
