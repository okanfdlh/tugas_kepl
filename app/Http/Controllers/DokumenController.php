<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::all();
        return view('dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        return view('dokumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        // Simpan file ke folder 'doku' di disk 'public'
        $filePath = $request->file('file')->store('doku', 'public');

        Dokumen::create([
            'nama_dokumen' => $request->nama_dokumen,
            'file' => $filePath
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $dok = Dokumen::where('id', $id)->first();
        $data = [
            'dokumen' => $dok
        ];
        return view('dokumen.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::find($id);
        if (!$dokumen) {
            return redirect()->route('dokumen.index')->with('success', 'Dokumen Tidak Ditemukan.');
        }

        if ($request->hasFile('file')) {
            if ($dokumen->file && Storage::disk('public')->exists($dokumen->file))
                Storage::disk('public')->delete($dokumen->file);

            $filePath = $request->file('file')->store('doku', 'public');
            $dokumen->file = $filePath;
        }
        $dokumen->nama_dokumen = $request->nama_dokumen;
        $dokumen->save();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen Berhasil Diupdate.');
    }

    public function delete($id)
    {
        $fileLama = DB::table('dokumens')->select('file')->where('id', $id)->get();
        foreach ($fileLama as $f1) {
            $fileLama = $f1->file;
        }

        $filePath = $fileLama;

        Storage::disk('public')->delete($filePath);
        Dokumen::where('id', $id)->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen Berhasil Dihapus.');
    }
}
