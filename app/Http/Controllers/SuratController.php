<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('judul', 'like', "%{$searchTerm}%");
        }

        $surats = $query->with('kategori')->paginate(10); // Sesuaikan dengan kebutuhan pagination Anda

        // Periksa apakah permintaan adalah AJAX
        if ($request->ajax()) {
            return view('partials.surat-table', compact('surats'))->render();
        }

        return view('surat.index', compact('surats'));
    }

 
    public function create()
    {
        $kategoris = Kategori::all();
        return view('surat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'file_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file_pdf')->store('pdf', 'public');

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'file_path' => $filePath,
        ]);

        return redirect()->route('surat.index')->with('success_create', 'Data berhasil disimpan!');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    public function showPdf($id)
    {
        $surat = Surat::findOrFail($id);

        $filePath = $surat->file_path;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        $absolutePath = Storage::disk('public')->path($filePath);

        return response()->file($absolutePath);
    }

    public function edit(Surat $surat)
{
    $kategoris = Kategori::all();
    return view('surat.edit', compact('surat', 'kategoris'));
}

public function update(Request $request, Surat $surat)
{
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'judul'       => 'required|string|max:255',
        'file_pdf'    => 'nullable|mimes:pdf|max:2048', // boleh kosong kalau tidak ganti
    ]);

    // update data utama
    $surat->update([
        'nomor_surat' => $request->nomor_surat,
        'kategori_id' => $request->kategori_id,
        'judul'       => $request->judul,
    ]);

    // kalau ada file baru diupload
    if ($request->hasFile('file_pdf')) {
        // hapus file lama
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        // simpan file baru
        $filePath = $request->file('file_pdf')->store('pdf', 'public');
        $surat->update(['file_path' => $filePath]);
    }

    return redirect()->route('surat.index', $surat->id)
                     ->with('success_create', 'Data berhasil diperbarui!');
}


    public function destroy(Surat $surat)
    {
        if (Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->route('surat.index')->with('success_delete', 'Surat berhasil dihapus!');
    }


    public function unduh(Surat $surat)
    {
        if (!Storage::disk('public')->exists($surat->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($surat->file_path, $surat->judul . '.pdf');
    }
}
