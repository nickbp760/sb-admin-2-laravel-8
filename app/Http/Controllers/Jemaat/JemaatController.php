<?php

namespace App\Http\Controllers\Jemaat;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jemaat; // Make sure the model is imported correctly

class JemaatController extends Controller
{
    public function index()
    {
        // Mengambil data jemaat
        $jemaat = Jemaat::all();

        // Menghitung distribusi usia
        $ageDistribution = $this->getAgeDistribution($jemaat);

        // Mengirim data jemaat dan distribusi usia ke view
        return view('jemaat.index', [
            'jemaat' => $jemaat,
            'ageDistribution' => $ageDistribution,
            'birthdaysThisWeek' => $this->getBirthdaysThisWeek()
        ]);
    }

    private function getAgeDistribution($jemaat)
    {
        // Hitung distribusi usia
        $ageGroups = [
            '0-9' => 0,
            '10-19' => 0,
            '20-29' => 0,
            '30-39' => 0,
            '40-49' => 0,
            '50-59' => 0,
            '60+' => 0,
        ];

        foreach ($jemaat as $member) {
            $age = Carbon::parse($member->tanggal_lahir)->age;

            if ($age < 10) {
                $ageGroups['0-9']++;
            } elseif ($age < 20) {
                $ageGroups['10-19']++;
            } elseif ($age < 30) {
                $ageGroups['20-29']++;
            } elseif ($age < 40) {
                $ageGroups['30-39']++;
            } elseif ($age < 50) {
                $ageGroups['40-49']++;
            } elseif ($age < 60) {
                $ageGroups['50-59']++;
            } else {
                $ageGroups['60+']++;
            }
        }

        return [
            'labels' => array_keys($ageGroups),
            'data' => array_values($ageGroups)
        ];
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

    public function getBirthdaysThisWeek()
    {
        // Mendapatkan tanggal saat ini
        $today = Carbon::now();
    
        // Menentukan hari Senin dari minggu ini
        $startDate = $today->copy()->startOfWeek(Carbon::MONDAY);
    
        // Menentukan hari Minggu dari minggu ini
        $endDate = $startDate->copy()->endOfWeek(Carbon::SUNDAY);
    
        // Mendapatkan data anggota
        $members = \DB::table('jemaat')
            ->select('nama', 'tanggal_lahir')
            ->get();
    
        $birthdaysThisWeek = [];
    
        foreach ($members as $member) {
            $birthDate = Carbon::parse($member->tanggal_lahir);
            $birthDateThisYear = $birthDate->copy()->year($today->year);
    
            // Cek apakah tanggal lahir berada dalam rentang tanggal
            if ($birthDateThisYear->between($startDate, $endDate)) {
                $birthdaysThisWeek[] = [
                    'nama' => $member->nama,
                    'tanggal' => $birthDateThisYear->format('d F'),
                ];
            }
        }
    
        return $birthdaysThisWeek;
    }
}