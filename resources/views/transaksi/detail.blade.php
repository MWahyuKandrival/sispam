@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Transaksi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_pelanggan">Nama Pelanggan</label>
                                <div class="form-control">{{ $transaksi->pelanggan->name }}</div>
                            </div>

                            <div class="form-group">
                                <label for="id_user">Nama Petugas</label>
                                <div class="form-control">{{ $transaksi->petugas->name }}</div>
                            </div>

                            <div class="form-group">
                                <label for="biaya_perkubik">Biaya Perkubik </label>
                                <div class="form-control">{{ $transaksi->biaya_perkubik }}</div>
                            </div>

                            <div class="form-group">
                                <label for="biaya_admin">Biaya Admin </label>
                                <div class="form-control">{{ $transaksi->biaya_admin }}</div>
                            </div>

                            <div class="form-group">
                                <label for="pemakaian_sebelum">Pemakaian Air</label>
                                <div class="form-control">{{ $transaksi->pemakaian }}</div>
                            </div>

                            <div class="form-group">
                                <label for="total_tagihan">Total Tagihan </label>
                                <div class="form-control">{{ $transaksi->total_tagihan }}</div>
                            </div>

                            <div class="form-group">
                                <label for="total_pembayaran">Total Pembayaran </label>
                                <div class="form-control">{{ $transaksi->total_pembayaran }}</div>
                            </div>

                            <div class="form-group">
                                <label for="total_pembayaran">Status </label>
                                <div class="form-control">{{ $transaksi->status }}</div>
                            </div>

                            <div class="form-group">
                                <label for="total_pembayaran">Tanggal </label>
                                <div class="form-control">{{ $tanggal->format('l, j F Y  h:i a') }}</div>
                            </div>

                            <a href="/admin/transaksi" class="btn btn-warning">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
