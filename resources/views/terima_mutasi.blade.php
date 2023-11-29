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
                        <tr>
                            <th>No</th>
                            <th>Nomer Mutasi</th>
                            <th>Kode</th>
                            <th>Nama Stok</th>
                            <th>Barcode</th>
                            <th>Jumlah Mutasi</th>
                            <th>Asal Mutasi</th>
                            <th>Tujuan Mutasi</th>
                            <th>Tanggal Mutasi</th>
                            <th>Keterangan</th>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nomer_mutasi }}</td>
                            <td>{{ $row->kode }}</td>
                            <td>{{ $row->nama_stok }}</td>
                            <td>{!! DNS1D::getBarcodeHTML((string)$row->barcode, 'UPCA',1.5, 30) !!}
                                p- {{ $row->barcode }}
                            </td>
                            <td>{{ $row->jumlah}}</td>
                            <td>{{ $row->asal_mutasi }}</td>
                            <td>{{ $row->tujuan_mutasi }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->keterangan }}</td>
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