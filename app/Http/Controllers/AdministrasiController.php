<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['administrasi'] = \App\Models\Administrasi::paginate(3);
        $data['judul'] = 'Data-Data Administrasi';
        return view('administrasi_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['list_user'] =
        \App\Models\Order::selectRaw("id,concat(id) as tampil")
        ->pluck('tampil','id');

        $data['list_pay'] = ['Ovo', 'Gopay', 'Dana', 'Debit'];
        $data['list_status'] = ['Sudah Bayar', 'Belum Bayar', 'Kredit'];

        return view('administrasi_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
           
        ]);

        $administrasi = new \App\Models\Administrasi();
        $administrasi->order_id = $request->order_id;
        $administrasi->metode_pembayaran = $request->metode_pembayaran;
        $administrasi->status_pembayaran = $request->status_pembayaran;
        $administrasi->save();
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
        $data['administrasi'] = \App\Models\Administrasi::findOrFail($id);
        $data['list_user'] =
        \App\Models\Order::selectRaw("id,concat(id) as tampil")
        ->pluck('tampil','id');

        $data['list_pay'] = ['Ovo', 'Gopay', 'Dana', 'Debit'];
        $data['list_status'] = ['Sudah Bayar', 'Belum Bayar', 'Kredit'];

        return view('administrasi_edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_id' => 'required',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
           
        ]);

        $administrasi = \App\Models\Administrasi::findOrFail($id);
        $administrasi->order_id = $request->order_id;
        $administrasi->metode_pembayaran = $request->metode_pembayaran;
        $administrasi->status_pembayaran = $request->status_pembayaran;
        $administrasi->save();
        return redirect('/administrasi')->with('pesan', 'Data sudah Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $administrasi = \App\Models\Administrasi::findOrFail($id);
        $administrasi ->delete();
        return back()->with('pesan', 'Data sudah Di Hapus');
        
    }
}
