<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mutasi;
use App\Models\stok_barang;
use App\Models\order;
use Illuminate\Support\Facades\DB;

class mutasi_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisi=auth()->user()->role;
        if($divisi == 'Staff Lapangan'){
            $status='Mutasi Lapangan';
        } else {
            $status='Mutasi Gudang';
        }
        $barang=stok_barang::paginate(30);
        $data = order::leftJoin('stok_barang', 'orders.kode', '=', 'stok_barang.kode')
                ->select('orders.*', 'stok_barang.*')->where('status_mutasi', '!=', 'Pending')
                ->orderBy('orders.id_order', 'desc')->paginate(25);
        return view('mutasi',compact('data','barang'));
    }
    public function terimaMutasi()
    {
        $divisi=auth()->user()->role;
        if($divisi == 'Staff Lapangan'){
            $status='Proses Lapangan';
        } else {
            $status='Proses Gudang';
        }
        $barang=stok_barang::paginate(30);
        $data = mutasi::leftJoin('stok_barang', 'mutasi.kode', '=', 'stok_barang.kode')
                ->select('mutasi.*', 'stok_barang.*')->where('status',$status)
                ->paginate(5);
         return view('terima_mutasi',compact('data','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $divisi=auth()->user()->role;
        if($divisi == 'Staff Lapangan'){
            $asal='Lapangan';
            $tujuan='Gudang';
            $status='Mutasi Lapangan';
        } else {
            $asal='Gudang';
            $tujuan='Lapangan';
            $status='Mutasi Gudang';
        }
        $mutasi = mutasi::create([
            'kode' => $request->kode,
            'jumlah' => $request->jumlah,
            'asal_mutasi' => $asal,
            'tujuan_mutasi' => $tujuan,
            'status' => $status
        ]);

        return redirect()->route('mutasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    
    }

    public function updateMutasiLapangan(Request $request)
    {
        $divisi=auth()->user()->role;
        if($divisi == 'Staff Lapangan'){
            $status='Mutasi Lapangan';
            $status2='Proses Gudang';
        } else {
            $status='Mutasi Gudang';
            $status2='Proses Lapangan';
        }
        $mutasi = mutasi::where('status', $status)->update([
            'nomer_mutasi' => $request->nomer_mutasi,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'status' => $status2
        ]);

        return redirect()->route('mutasi.index')->with('success','Berhasil Melakukan Mutasi');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
