<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['detail_order'] = \App\Models\DetailOrder::paginate(3);
        $data['judul'] = 'Data-Data Order Detail';
        return view('detail_order_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_user'] =
            \App\Models\Order::selectRaw("id,concat(id) as tampil")
            ->pluck('tampil', 'id');
        $data['list_barang'] =
            \App\Models\Barang::selectRaw("id,concat(id) as tampil")
            ->pluck('tampil', 'id');
        return view('detail_order_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'barang_id' => 'required',
            'jumlah_produk' => 'required',
            'harga' => 'required'
        ]);

        $detail_order = new \App\Models\DetailOrder();
        $detail_order->order_id = $request->order_id;
        $detail_order->barang_id = $request->barang_id;
        $detail_order->jumlah_produk = $request->jumlah_produk;
        $detail_order->harga = $request->harga;
        $detail_order->save();
        return back()->with('pesan', 'Data sudah Disimpan');
    }

    /**
     * Display the specified@empty ($record) 
        
     @endempty resource.
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
        $data['detail_order'] = \App\Models\DetailOrder::findOrFail($id);
        $data['list_user'] =
            \App\Models\Order::selectRaw("id,concat(id) as tampil")
            ->pluck('tampil', 'id');
        $data['list_barang'] =
            \App\Models\Barang::selectRaw("id,concat(id) as tampil")
            ->pluck('tampil', 'id');
        return view('detail_order_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'order_id' => 'required',
            'barang_id' => 'required',
            'jumlah_produk' => 'required',
            'harga' => 'required'
        ]);

        $detail_order = \App\Models\DetailOrder::findOrFail($id);
        $detail_order->order_id = $request->order_id;
        $detail_order->barang_id = $request->barang_id;
        $detail_order->jumlah_produk = $request->jumlah_produk;
        $detail_order->harga = $request->harga;
        $detail_order->save();
        return redirect('/detail_order')->with('pesan', 'Data sudah Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail_order = \App\Models\DetailOrder::findOrFail($id);
        $detail_order->delete();
        return back()->with('pesan', 'Data sudah Di Hapus');
    }
}
