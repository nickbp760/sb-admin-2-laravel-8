<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// panggil model jemaat
use App\Models\Jemaat; // Pastikan model diimpor dengan benar

class JemaatController extends Controller
{
    public function index()
    {
    	// mengambil data jemaat
    	$jemaat = Jemaat::all();
 
    	// mengirim data jemaat ke view jemaat
    	return view('jemaat', ['jemaat' => $jemaat]);
    }

	public function tambah()
    {
    	return view('jemaat_tambah');
    }

	public function store(Request $request)
    {
    	$this->validate($request,[
    		'nama' => 'required',
    		'alamat' => 'required'
    	]);
 
        Jemaat::create([
    		'nama' => $request->nama,
    		'alamat' => $request->alamat
    	]);
 
    	return redirect('/jemaat');
    }

	public function edit($id)
	{
		$jemaat = Jemaat::find($id);
		return view('jemaat_edit', ['jemaat' => $jemaat]);
	}

	public function update($id, Request $request)
	{
		$this->validate($request,[
		'nama' => 'required',
		'alamat' => 'required'
		]);
	
		$jemaat = Jemaat::find($id);
		$jemaat->nama = $request->nama;
		$jemaat->alamat = $request->alamat;
		$jemaat->save();
		return redirect('/jemaat');
	}

	public function delete($id)
	{
		$jemaat = Jemaat::find($id);
		$jemaat->delete();
		return redirect('/jemaat');
	}
}
