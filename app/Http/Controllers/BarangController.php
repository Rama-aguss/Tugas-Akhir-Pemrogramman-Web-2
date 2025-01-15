<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang'] = \App\Models\Barang::paginate(3);
        $data['judul'] = 'Data-Data Barang';
        return view('barang_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_merk'] = ['Advan', 'Samsung', 'Xiaomi', 'Apple', 'Huawei', 'Poco', 'Oppo', 'Vivo', 'Realme'];
        return view('barang_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|unique:barangs,nama_barang',
            'merek' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        $barang = new \App\Models\Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->merek = $request->merek;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->save();
        return back()->with('pesan', 'Data sudah Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['barang'] = \App\Models\Barang::findOrFail($id);
        $data['list_merk'] = ['Advan', 'Samsung', 'Xiaomi', 'Apple', 'Huawei', 'Poco', 'Oppo', 'Vivo', 'Realme'];
        return view('barang_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required|unique:barangs,nama_barang,' . $id,
            'merek' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        $barang = \App\Models\Barang::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->merek = $request->merek;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->save();

        return redirect('/barang')->with('pesan', 'Data sudah Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = \App\Models\Barang::findOrfail($id);
        $barang->delete();
        return back()->with('pesan', 'Data Sudah Dihapus');
    }

    public function laporan()
    {
        $data['barang'] = \App\Models\Barang::all();
        $data['judul'] = 'Laporan Data Penjualan';
        return view('barang_laporan', $data);
    }
}
