<?php

namespace App\Http\Controllers\Jemaat;
use Illuminate\Support\Facades\Storage;

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
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'kota' => 'nullable|string|max:25',
            'kode_pos' => 'nullable|string|max:10',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'status_baptisan' => 'nullable|string|in:Sudah,Belum',
            'tanggal_baptisan' => 'nullable|date',
            'status_anggota' => 'nullable|string|in:Jemaat Umum,Anggota Aktif,Tamu',
            'waktu_bergabung' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    	]);
		$fotoPath = $request->file('foto') ? $request->file('foto')->store('public/foto') : null;
 
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
			'foto' => $fotoPath
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
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'kota' => 'nullable|string|max:25',
            'kode_pos' => 'nullable|string|max:10',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'status_baptisan' => 'nullable|string|in:Sudah,Belum',
            'tanggal_baptisan' => 'nullable|date',
            'status_anggota' => 'nullable|string|in:Jemaat Umum,Anggota Aktif,Tamu',
            'waktu_bergabung' => 'nullable|date',
			'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
		]);
		$jemaat = Jemaat::find($id);

		if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($jemaat->foto && Storage::exists($jemaat->foto)) {
                Storage::delete($jemaat->foto);
            }
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('public/foto');
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $fotoPath = $jemaat->foto;
        }

		$jemaat->update([
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
            'foto' => $fotoPath,
        ]);
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
