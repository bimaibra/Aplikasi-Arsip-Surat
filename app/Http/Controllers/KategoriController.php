<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('id', 'asc')->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
            'keterangan' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->surats()->count() > 0) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak dapat dihapus karena sedang digunakan oleh arsip surat.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success_delete', 'Kategori berhasil dihapus!');
    }
}
