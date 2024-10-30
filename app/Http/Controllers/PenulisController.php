<?php

namespace App\Http\Controllers;

use App\Models\penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penulis = penulis::orderBy('created_at', 'desc')->get();
        return view('backend.penulis.index', compact('penulis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image',
            'nama' => 'required|string',
            'alamat' =>'required|string',
            'email' =>'required|email|unique:penulis',
            'telp' =>'required|string|unique:penulis'
        ]);

        $data = $request->all();

        if($request->hasFile('foto')) {
            $data['foto'] = Storage::putFile('/penulis', $request->file('foto'));
        }

        $penulis = penulis::create($data);

        if ($penulis) {
            return redirect()->to('/penulis')->withSuccess('Penulis berhasil ditambahkan!');
        } else {
            return back()->withInput()->withErrors('Penulis gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(penulis $penulis)
    {
        return view('backend.penulis.show', compact('penulis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penulis $penulis)
    {
        
        return view('backend.penulis.edit', compact('penulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, penulis $penulis)
    {
        $request->validate([
            'foto' => 'image',
            'nama' => 'required|string',
            'alamat' =>'required|string',
            'email' =>'required|email',
            'telp' =>'required|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($penulis->foto && Storage::exists($penulis->foto)) {
                Storage::delete($penulis->foto);
            }

            $data['foto'] = Storage::putFile('/penulis', $request->file('foto'));
        }

        $penulis->update($data);

        if ($penulis) {
            return redirect()->to('/penulis')->withSuccess('Penulis berhasil diperbarui!');
        } else {
            return back()->withInput()->withErrors('Penulis gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penulis $penulis)
    {
        if ($penulis->foto && Storage::exists($penulis->foto)) {
            Storage::delete($penulis->foto);
        }

        $penulis->delete();

        if ($penulis) {
            return back()->withSuccess('Penulis berhasil dihapus!');
        } else {
            return back()->withInput()->withErrors('Penulis gagal dihapus!');
        }
    }
}
