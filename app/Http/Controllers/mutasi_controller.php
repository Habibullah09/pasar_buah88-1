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
       $data = mutasi::leftJoin('orders as o', 'o.id_order', '=', 'mutasi.id_order')
        ->leftJoin('stok_barang as sb', 'o.kode', '=', 'sb.kode')
        ->leftJoin('users as u', 'o.user_id', '=', 'u.id')
        ->select('mutasi.*', 'o.*', 'sb.*', 'u.*')
        ->orderBy('o.id_order', 'desc')
        ->paginate(25);
       return view('mutasi',compact('data'));
    }
    public function terimaMutasi()
    {
       $data = mutasi::leftJoin('orders as o', 'o.id_order', '=', 'mutasi.id_order')
        ->leftJoin('stok_barang as sb', 'o.kode', '=', 'sb.kode')
        ->leftJoin('users as u', 'o.user_id', '=', 'u.id')
        ->select('mutasi.*', 'o.*', 'sb.*', 'u.*')->where('status_mutasi','Dikirim')
        ->paginate(25);
         return view('terima_mutasi',compact('data'));
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
        $data = mutasi::leftJoin('orders as o', 'o.id_order', '=', 'mutasi.id_order')
        ->leftJoin('stok_barang as sb', 'o.kode', '=', 'sb.kode')
        ->leftJoin('users as u', 'o.user_id', '=', 'u.id')
        ->select('mutasi.*', 'o.*', 'sb.*', 'u.*')
        ->orderBy('o.id_order', 'desc')
        ->paginate(25);
        $mutasi = mutasi::leftJoin('orders as o', 'o.id_order', '=', 'mutasi.id_order')
        ->leftJoin('stok_barang as sb', 'o.kode', '=', 'sb.kode')
        ->leftJoin('users as u', 'o.user_id', '=', 'u.id')
        ->select('mutasi.*', 'o.*', 'sb.*', 'u.*')->where('id_mutasi',$id)
        ->first();
       return view('mutasi',compact('mutasi','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('mutasi')->where('id_mutasi',$id)->update([
                'jumlah_mutasi' => $request->jumlah
        ]);
        return redirect()->route('mutasi.index')->with('success','Berhasil Menambahkan Qty Mutasi');
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

    public function mutasi()
    {
        $data = mutasi::where('status_mutasi','Pending')->get();
        if($data){
            DB::table('mutasi')->where('status_mutasi','Pending')->update([
                'status_mutasi' => "Dikirim",
                'tgl_mutasi' => now()->format('Y-m-d')
            ]);
            return redirect()->route('mutasi.index')->with('success','Berhasil Melakukan Mutasi');
        } else {
            return redirect()->route('mutasi.index')->with('error','Belum ada Order yang Akan di Mutasi');
        }
    }
}
