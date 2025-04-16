<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index(){
        $arsip = Arsip::with(['lokasi', 'data_user'])->get();
        $lokasi = Lokasi::all();
        return view('arsip.index', compact('arsip', 'lokasi'));
    }

    public function create(){
        $lokasi = Lokasi::all();
        return view('arsip.create', compact('lokasi'));
;    }

    public function store(Request $request){
        $ambilUser = Session::get('ambilUser');
        $id_user = $ambilUser->id;

        $request->validate([
            'nama_dokumen' => 'required',
            'id_lokasi' => 'required|exists:lokasi,id',
            'file_arsip' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $filePath = $request->file('file_arsip')->store('arsip_files', 'public');

        Arsip::create([
            'nama_dokumen' => $request->nama_dokumen,
            'id_lokasi' => $request->id_lokasi,
            'id_user' => $id_user,
            'file_arsip' => $filePath
        ]);

        return redirect()->route('arsip.index')->with('success', 'Arsip Created Successfully');
    }

    public function edit(Arsip $arsip){
        $lokasi = Lokasi::all();
        return view('arsip.edit', compact('lokasi','arsip'));
    }

    public function update(Request $request, Arsip $arsip){
        $request->validate([
            'nama_dokumen' => 'required',
            'id_lokasi' => 'required|exists:lokasi,id',
            'file_arsip' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if($request->hasFile('file_arsip')){
            Storage::disk('public')->delete($arsip->file_arsip);
            $filePath = $request->file('file_arsip')->store('arsip_files', 'public');
            $arsip->file_arsip = $filePath;
        }

        $arsip->update([
            'nama_dokumen' => $request->nama_dokumen,
            'id_lokasi' =>$request->id_lokasi
        ]);
        return redirect()->route('arsip.index')->with('success', 'Arsip Updated Successfully');
    }

    public function destroy(Arsip $arsip){
        Storage::disk('public')->delete($arsip->file_arsip);
        $arsip->delete();
        return redirect()->route('arsip.index')->with('success', 'Arsip Deleted Sucessfully');
    }
}
