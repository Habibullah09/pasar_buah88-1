@extends('layout.master')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Akun</h1>
         @if(auth()->user()->role == 'Supervisor IT')
        <a type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Akun</a>
        @endif
    </div>
     <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th>Aksi</th>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->role }}</td>
                            <td><a href="{{ route('akun.edit', $row->id) }}" class="btn btn-info btn-rounded btn-sm">EDIT</a>
                           <a href="{{ route('akun.destroy', $row->id) }}"
                            id="btn-delete-post"
                            class="btn btn-danger btn-rounded btn-sm"
                            onclick="event.preventDefault(); if(confirm('Yakin akan menghapus Data?')) { document.getElementById('delete-form-{{$row->id}}').submit(); }">
                            DELETE
                            </a>
                            <form id="delete-form-{{$row->id}}" action="{{ route('akun.destroy', $row->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
               {{ $data->links() }}
            </div>
        </div>
    </div>

<!-- Modal Tambah Materi -->
<div class="modal fade" id="modalTambah" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        @if(isset($akun))
            <h5 class="modal-title" id="modalTambahMateriLabel">Ubah Akun</h5>
        @else
            <h5 class="modal-title" id="modalTambahMateriLabel">Tambah Akun</h5>
        @endif
        <a type="button" class="close" href="{{ url('/akun') }}">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
       <form action="{{ isset($akun) ? route('akun.update', $akun->first()->id) : route('akun.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
         @if(isset($akun))
                @method('PUT')
         @endif
        <div class="form-group required">
        <label class="d-flex flex-row align-items-center" for="nama">Nama</label>
        <input type="text" class="form-control text-lowercase" id="name" required name="name" placeholder="Nama Lengkap" value="{{ isset($akun) ? $akun->first()->name : '' }}">
        @error('nama')
        <div class="alert-denger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group required">
        <label class="d-flex flex-row align-items-center" for="nama">Email</label>
        <input type="email" class="form-control text-lowercase" id="email" required name="email" placeholder="Email"  value="{{ isset($akun) ? $akun->first()->email : '' }}">
        @error('email')
        <div class="alert-denger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group required">
        <label class="d-flex flex-row align-items-center" for="nama">Password</label>
        <input type="password" class="form-control text-lowercase" id="password"  name="password" placeholder="{{ isset($akun) ? 'Password diamankan' : 'Password' }}">
        @if(isset($akun))
            <label class="d-flex flex-row align-items-center" style="color:red">Tidak Perlu diisi jika tidak ingin mengganti password</label>
        @endif
        @error('password')
        <div class="alert-denger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group required">
        <label class="d-flex flex-row align-items-center" for="nama">Divisi</label>
        <select name="role" id="role" class="form-control bg-light" required>
            <option value="Staff Lapangan" {{ old('role', isset($akun) ? $akun->first()->role : '') == 'Staff Lapangan' ? 'selected' : '' }}>Staff Lapangan</option>
            <option value="Staff Gudang" {{ old('role', isset($akun) ? $akun->first()->role : '') == 'Staff Gudang' ? 'selected' : '' }}>Staff Gudang</option>
            <option value="Staff IT" {{ old('role', isset($akun) ? $akun->first()->role : '') == 'Staff IT' ? 'selected' : '' }}>Staff IT</option>
            <option value="Supervisor IT" {{ old('role', isset($akun) ? $akun->first()->role : '') == 'Supervisor IT' ? 'selected' : '' }}>Supervisor IT</option>
        </select>
        @error('role')
        <div class="alert-denger">{{ $message }}</div>
        @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ url('/akun') }}" type="button" class="btn btn-light" >Cancel</a>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Add this to your master layout file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        @if(!empty($akun))
        $('#modalTambah').modal('show'); // Show the modal if editing
        @endif
    });
</script>
@stop