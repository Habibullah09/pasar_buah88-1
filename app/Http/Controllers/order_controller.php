<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\mutasi;
use App\Models\stok_barang;
use Illuminate\Support\Facades\DB;

class order_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang=stok_barang::paginate(10);
        $data = order::leftJoin('stok_barang', 'orders.kode', '=', 'stok_barang.kode')
                ->select('orders.*', 'stok_barang.*')->orderBy('orders.id_order', 'desc')->paginate(25);
        $no = Order::select('no_order')
        ->where('status_order', 'Diajukan')
        ->orderBy('id_order', 'desc')
        ->limit(1)
        ->first();
    
        if ($no) {
            $order= $no->no_order;
            $no_order = 'OR-'.($order + 1);
        } else {
            $no_order = 'OR-1';
        }
        // dd($no_order);
        return view('order',compact('data','barang','no_order'));
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
        $order = order::create([
            'kode' => $request->kode,
            'jumlah' => $request->jumlah
        ]);
        return redirect()->route('order.index');
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
        $dt = order::leftJoin('stok_barang', 'orders.kode', '=', 'stok_barang.kode')
            ->select('orders.*', 'stok_barang.*')
            ->where('orders.id_order', $id)
            ->first(); 

        $row = array();
        if ($dt) {
            $row['data'] = TRUE;
            $row['kode'] = $dt->kode;
            $row['barcode'] =  $dt->barcode;
            $row['nama_stok'] =  $dt->nama_stok;
            $row['jumlah'] =  $dt->jumlah;
            $row['id_order'] =  $dt->id_order;

        } else {
            $row['data'] = FALSE;
        }
        echo json_encode($row);
        die;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id_order;

       DB::table('orders')->where('id_order', $id)->update([
        'kode' => $request->kode,
        'jumlah' => $request->jumlah
        ]);
        return redirect()->route('order.index')->with('success','Data Order Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('orders')->where('id_order',$id)->delete();
        return redirect()->route('order.index')->with('success','Berhasil Menghapus Order');
    }

     public function order()
    {
        $data = order::where('status_order','Pending')->get();
        if($data->count() > 0){        
            $no = Order::select('no_order')
            ->where('status_order', 'Diajukan')
            ->orderBy('id_order', 'desc')
            ->limit(1)
            ->first();

            if ($no) {
                $order= $no->no_order;
                $no_order = ($order+ 1);
            } else {
                $no_order = 1;
            }

            $order = order::where('status_order', 'Pending')->update([
                'status_order' => 'Diajukan',
                'no_order' => $no_order,
                'tgl_order' => now()->format('Y-m-d H:i:s')
            ]);


            //Insert Mutasi
            $pengajuan_order = order::where('status_order','Diajukan')->get();
            foreach($pengajuan_order as $list){
                $id = $list->id_order;
                $mutasi = mutasi::create([
                'id_order' => $id
            ]);

            }

            return redirect()->route('order.index')->with('success','Berhasil Melakukan Order');
        } else {
            return redirect()->route('order.index')->with('error','Belum ada Order Baru Semua status Sudah Diajukan');
        }

    }
}
