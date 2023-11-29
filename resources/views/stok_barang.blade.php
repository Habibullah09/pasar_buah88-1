@extends('layout.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Stok Barang</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <div class="row" style="margin-top:-30px">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stok Barang</h4>
                        <div class="table-responsive">
                            <table class="table">
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
                                    <td>{!! DNS1D::getBarcodeHTML((string)$row->barcode, 'UPCA', 1.5, 30) !!}
                                        {{ $row->barcode }}
                                    </td>
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
            </div>
        </div>
    </div>
</div>
@stop