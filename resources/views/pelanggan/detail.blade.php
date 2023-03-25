@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Pelanggan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Detail Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID Pelanggan</label>
                                <input type="text" class="form-control" name="id" id="id"
                                    value="{{ $pelanggan->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Pelanggan</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $pelanggan->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Pelanggan</label>
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    value="{{ $pelanggan->alamat }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">Nomor Telephone</label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp"
                                    value="{{ $pelanggan->no_telp }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Pelanggan</label>
                                <input type="text" class="form-control" name="status" id="status"
                                    value="{{ $pelanggan->status }}" readonly>
                            </div>
                            {{-- <div class="form-group">
                                <label for="kode_mesin">Kode Mesin</label>
                                <input type="text" class="form-control"
                                    name="kode_mesin" id="kode_mesin" value="{{ $pelanggan->kode_mesin }}" readonly>
                            </div> --}}
                            <div class="form-group">
                                <label for="id_user">Petugas</label>
                                <input type="text" class="form-control" name="id_user" id="id_user"
                                    value="{{ !empty($pelanggan->petugas->name) ? $pelanggan->petugas->name : '-' }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="id_user">QR-Code</label>
                                <div class="">
                                    {{ url("/tagihan/".$pelanggan->id) }}
                                    {!! QrCode::size(300)->generate(url("/tagihan/".$pelanggan->id)) !!}
                                </div>  
                            </div>
                            @if (auth()->user()->role === 'Admin')
                                <a href="/admin/pelanggan" class="btn btn-warning">Back</a>
                            @else
                                <a href="/petugas/pelanggan" class="btn btn-warning">Back</a>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Transaksi Pelanggan</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
