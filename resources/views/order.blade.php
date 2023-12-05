@extends('layout.master')
@section('css')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Order Barang</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <div class="row" style="margin-top:-30px">
           <a type="button" class="btn btn-success mb-2 ml-3" data-toggle="modal" data-target="#modalTambah">Tambah Order</a>
           <a type="button" href="{{url('/kirim_order')}}" class="btn btn-warning mb-2 ml-3" >Kirim Order</a>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Barang</h4>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Stok</th>
                                <th>Barcode</th>
                                <th>Qty Lapangan</th>
                                <th>Qty Gudang Kecil</th>
                                <th>Qty Order</th>
                                <th>Status Order</th>
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
                                <td>{{ $row->jumlah }}</td>
                                <td><label class="badge  {{ $row->status_order == 'Pending' ? 'badge-warning' : 
                                    ($row->status_order == 'Diajukan' ? 'badge-info' : 
                                    ($row->status_order == 'Selesai' ? 'badge-success' : 'badge-secondary')) 
                                    }}">{{ $row->status_order }}</label></td>
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
<!-- Modal Tambah Materi -->
<div class="modal fade" id="modalTambah" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Order</h4>
                        <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" id="barang">
                            <label class="d-flex flex-row align-items-center">
                                Pilih Barang
                            </label>
                            <div>
                                <select class="form-control" name="kode" id="kode">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-flex flex-row align-items-center" for="nama">Jumlah Order</label>
                            <input type="number" class="form-control" id="jumlah"  name="jumlah" placeholder="Jumlah">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#kode").select2({
            width: "100%",
            closeOnSelect: true,
            placeholder: "Cari kode, barcode atau nama barang",
            ajax: {
                url: "/getKode",
                dataType: "json",
                type: "GET",
                delay: 250,
                data: function(e) {
                    return {
                        searchtext: e.term,
                        page: e.page
                    }
                },
                processResults: function(e, t) {
                    $(e.items).each(function() {
                        this.id = this.kode;
                        this.text = `${this.kode}`;
                    });

                    return t.page = t.page || 1, {
                        results: e.items,
                    }
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 1,
            templateResult: function (data) {
                if (data.loading) return data.text;

                var markup =
                    `<div class='select2-result-repository clearfix'>
                        <div class='select2-result-repository_meta'>
                            <div class='select2-result-repository_title'>
                                ${data.kode} - ${data.barcode} - ${data.nama_stok}
                            </div>
                        </div>
                    </div>`;

                return markup;
            },
            templateSelection: function (data) {
                return data.text;
            }
        });
    });
</script>
@stop