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
		return view('jemaat.jemaat_edit', ['jemaat' => $jemaat]);
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
		
		if ($jemaat) {
			$jemaat->delete();
			return response()->json(['success' => true, 'redirect' => route('jemaat.index')]);
		}

		return response()->json(['success' => false], 404);
	}
}
