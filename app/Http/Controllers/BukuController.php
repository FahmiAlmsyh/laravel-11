<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('backend.buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penulis = penulis::get();
        return view('backend.buku.create', compact('penulis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image',
            'judul' => 'required|string',
            'penulis_id' => 'required|numeric',
            'tahun_terbit' => 'required|numeric|max_digits:4',
            'penerbit' => 'required|string',
            'jenis' => 'required|string',
            'sinopsis' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = Storage::putFile('/buku', $request->file('foto'));
        }

        $buku = Buku::create($data);

        if ($buku) {
            return redirect()->to('/buku')->withSuccess('Buku berhasil ditambahkan!');
        } else {
            return back()->withInput()->withErrors('Buku gagal ditambahkan!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $penulis = penulis::get();
        return view('backend.buku.update', compact('buku', 'penulis'));
    }

      /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        return view('backend.buku.show', compact('buku'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'foto' => 'nullable|image',
            'judul' => 'required|string',
            'penulis_id' => 'required|string',
            'tahun_terbit' => 'required|numeric|max_digits:4',
            'penerbit' => 'required|string',
            'jenis' => 'required|string',
            'sinopsis' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($buku->foto && Storage::exists($buku->foto)) {
                Storage::delete($buku->foto);
            }

            $data['foto'] = Storage::putFileAS('/buku', $request->file('foto'), now(). '-' . $request->file('foto')->getClientOriginalName());
        }

        $buku->update($data);

        if ($buku) {
            return redirect()->to('/buku')->withSuccess('Buku berhasil diperbarui!');
        } else {
            return back()->withInput()->withErrors('Buku gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if ($buku->foto && Storage::exists($buku->foto)) {
            Storage::delete($buku->foto);
        }

        $buku->delete();

        if ($buku) {
            return back()->withSuccess('Buku berhasil dihapus!');
        } else {
            return back()->withInput()->withErrors('Buku gagal dihapus!');
        }
    }


}
