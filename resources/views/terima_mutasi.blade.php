@extends('layout.master')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Terima Mutasi</h3>
                </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <div class="row" style="margin-top:-50px">
            <div class="form-group" style="margin-left:20px">
                <label class="d-flex flex-row align-items-center" for="nama">&nbsp;</label>
                <a type="button" href="{{url('/terima_mutasi')}}" class="btn btn-success mr-2">Terima Mutasi</a>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Mutasi Barang</h4>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                        <table class="table">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>No Order</th>
                                <th>Kode</th>
                                <th>Nama Stok</th>
                                <th>Barcode</th>
                                <th>Qty Lapangan</th>
                                <th>Qty Gudang Kecil</th>
                                <th>Qty Order</th>
                                <th>Tanggal Order</th>
                                <th>Request By</th>
                                <th>Qty Mutasi</th>
                                <th>Status Mutasi</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($data as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->no_order }}</td>
                                <td>{{ $row->kode }}</td>
                                <td>{{ $row->nama_stok }}</td>
                                <td>{{ $row->barcode }}</td>
                                <td>{{ $row->qty_lapangan }}</td>
                                <td>{{ $row->qty_gudang_kecil}}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>{{ $row->tgl_order }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->jumlah_mutasi }}</td>
                                <td><label class="badge  {{ $row->status_mutasi == 'Pending' ? 'badge-warning' : 
                                    ($row->status_mutasi == 'Dikirim' ? 'badge-info' : 
                                    ($row->status_mutasi == 'Diterima' ? 'badge-success' : 'badge-secondary')) 
                                    }}">{{ $row->status_mutasi }}</label></td>
                            </tr>
                        @endforeach
                        </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@stop