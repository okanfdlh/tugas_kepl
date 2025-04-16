<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class LokasiController extends Controller
{
    public function index(){
        $lokasi = Lokasi::all();
        return view('lokasi.index', compact('lokasi'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_lokasi' => 'required'
        ]);

        Lokasi::create($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi Created Successfully');
    }

    public function edit(Lokasi $lokasi){
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi){
        $request->validate([
            'nama_lokasi' => 'required'
        ]);

        $lokasi->update($request->all());
        return redirect()->route('lokasi.index')->with('success', 'Lokasi Updated Successfully');
    }

    public function destroy(Lokasi $lokasi){
        $lokasi->delete();
        return redirect()->route('lokasi.index')->with('success', 'Lokasi Deleted Sucessfully');
    }
}
