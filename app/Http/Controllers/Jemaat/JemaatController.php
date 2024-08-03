<?php

namespace App\Http\Controllers\Jemaat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaat; // Make sure the model is imported correctly

class JemaatController extends Controller
{
    public function index()
    {
    	// mengambil data jemaat
    	$jemaat = Jemaat::all();
 
    	// mengirim data jemaat ke view jemaat
    	return view('jemaat.index', ['jemaat' => $jemaat]);
    }

	public function tambah()
    {
    	return view('jemaat.jemaat_tambah');
    }

	public function store(Request $request)
    {
    	$this->validate($request,[
			'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'kota' => 'nullable|string|max:25',
            'kode_pos' => 'nullable|string|max:10',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'status_baptisan' => 'nullable|string|in:Sudah,Belum',
            'tanggal_baptisan' => 'nullable|date',
            'status_anggota' => 'nullable|string|in:Jemaat Umum,Anggota Aktif,Tamu',
            'waktu_bergabung' => 'nullable|date'
    	]);
 
        Jemaat::create([
			'nama' => $request->nama,
			'alamat' => $request->alamat,
			'jenis_kelamin' => $request->jenis_kelamin,
			'tanggal_lahir' => $request->tanggal_lahir,
			'kota' => $request->kota,
			'kode_pos' => $request->kode_pos,
			'nomor_telepon' => $request->nomor_telepon,
			'email' => $request->email,
			'status_baptisan' => $request->status_baptisan,
			'tanggal_baptisan' => $request->tanggal_baptisan,
			'status_anggota' => $request->status_anggota,
			'waktu_bergabung' => $request->waktu_bergabung,
		]);
 
    	return redirect('/jemaat');
    }

	public function edit($id)
	{
		$jemaat = Jemaat::find($id);
		return view('jemaat.jemaat_edit', ['jemaat' => $jemaat]);
	}

	public function update($id, Request $request)
	{
		$this->validate($request,[
			'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'kota' => 'nullable|string|max:25',
            'kode_pos' => 'nullable|string|max:10',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'status_baptisan' => 'nullable|string|in:Sudah,Belum',
            'tanggal_baptisan' => 'nullable|date',
            'status_anggota' => 'nullable|string|in:Jemaat Umum,Anggota Aktif,Tamu',
            'waktu_bergabung' => 'nullable|date'
		]);
	
		$jemaat = Jemaat::find($id);
		$jemaat->nama = $request->nama;
		$jemaat->alamat = $request->alamat;
		$jemaat->jenis_kelamin = $request->jenis_kelamin;
		$jemaat->tanggal_lahir = $request->tanggal_lahir;
		$jemaat->kota = $request->kota;
		$jemaat->kode_pos = $request->kode_pos;
		$jemaat->nomor_telepon = $request->nomor_telepon;
		$jemaat->email = $request->email;
		$jemaat->status_baptisan = $request->status_baptisan;
		$jemaat->tanggal_baptisan = $request->tanggal_baptisan;
		$jemaat->status_anggota = $request->status_anggota;
		$jemaat->waktu_bergabung = $request->waktu_bergabung;
		$jemaat->save();
		return redirect('/jemaat');
	}

	public function delete($id)
	{
		$jemaat = Jemaat::find($id);
		
		if ($jemaat) {
			$jemaat->delete();
			return response()->json(['success' => true, 'redirect' => route('jemaat.index')]);
		}

		return response()->json(['success' => false], 404);
	}
}
