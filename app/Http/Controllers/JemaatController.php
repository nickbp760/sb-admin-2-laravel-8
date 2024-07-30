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
}
