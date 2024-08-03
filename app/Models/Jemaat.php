<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;
    protected $table = "jemaat";
    protected $fillable = [
        'nama',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'kota',
        'kode_pos',
        'nomor_telepon',
        'email',
        'status_baptisan',
        'tanggal_baptisan',
        'status_anggota',
        'waktu_bergabung',
        'foto'
    ];
    protected $dates = ['tanggal_lahir', 'tanggal_baptisan', 'waktu_bergabung']; // Define date columns here
}
