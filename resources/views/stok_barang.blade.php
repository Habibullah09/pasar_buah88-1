@extends('layout.master')
@section('content')
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Stok Barang</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stok Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Stok</th>
                            <th>Barcode</th>
                            <th>Qty Lapangan</th>
                            <th>Qty Gudang Kecil</th>
                            <th>Qty Gudang Besar</th>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->kode }}</td>
                            <td>{{ $row->nama_stok }}</td>
                            <td>{{ $row->barcode }}</td>
                            <td>{{ $row->qty_lapangan }}</td>
                            <td>{{ $row->qty_gudang_kecil}}</td>
                            <td>{{ $row->qty_gudang_besar }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>

@stop