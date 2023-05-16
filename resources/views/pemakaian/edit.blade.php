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
                            <h4>Form Edit Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <form action="/admin/transaksi/{{ $transaksi->id_transaksi }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="id_pelanggan">Nama Pelanggan</label>
                                    <input type="text" class="form-control" name="id_pelanggan"
                                        value="{{ $transaksi->id_pelanggan }}" readonly>
                                    {{-- <select class="form-control @error('id_pelanggan') is-invalid  @enderror select2"
                                        name="id_pelanggan" id="select_pelanggan">
                                        <option value="">Silahkan Pilih Pelanggan</option>
                                        @forelse ($pelanggan as $s)
                                            <option value="{{ $s->id }}" data-petugas="{{ $s->id_user }}"
                                                @if ($transaksi->id_pelanggan == $s->id) selected="selected" @endif>
                                                {{ $s->name }} - {{ $s->id }}
                                            </option>
                                        @empty
                                            <option value="">Tidak Ada Data Pelanggan</option>
                                        @endforelse
                                    </select> --}}
                                    @error('id_pelanggan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="id_user">Nama Petugas</label>
                                    <input type="text" class="form-control" name="id_user"
                                        value="{{ $transaksi->id_user }}" readonly>
                                    {{-- <select class="form-control @error('id_user') is-invalid  @enderror select2"
                                        name="id_user" id="select_petugas">
                                        <option value="">Silahkan Pilih Pelanggan Terlebih Dahulu</option>
                                        @forelse ($petugas as $s)
                                            <option value="{{ $s->id }}"
                                                @if ($transaksi->id_user == $s->id) selected="selected" @endif>
                                                {{ $s->name }} - {{ $s->id }}
                                            </option>
                                        @empty
                                            <option value="">Tidak Ada Data Petugas</option>
                                        @endforelse
                                    </select> --}}
                                    @error('id_user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="biaya_perkubik">Biaya Perkubik </label>
                                    <input type="text" name="biaya_perkubik_readonly" id="biaya_perkubik_readonly"
                                        class="form-control @error('biaya_perkubik') is-invalid @enderror"
                                        value="Rp. {{ number_format($transaksi->biaya_perkubik) }}" readonly>
                                    <input type="hidden" name="biaya_perkubik" id="biaya_perkubik"
                                        value="{{ $transaksi->biaya_perkubik }}">
                                    @error('biaya_perkubik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="biaya_admin">Biaya Admin </label>
                                    <input type="text" name="biaya_admin_readonly" id="biaya_admin_readonly"
                                        class="form-control @error('biaya_admin') is-invalid @enderror"
                                        value="Rp. {{ number_format($transaksi->biaya_admin) }}" readonly>
                                    <input type="hidden" name="biaya_admin" id="biaya_admin"
                                        value="{{ $transaksi->biaya_admin }}">
                                    @error('biaya_admin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pemakaian_sebelum">Pemakaian Air Bulan Sebelumnya</label>
                                    <input type="text" class="form-control" id="pemakaian_sebelum"
                                        name="pemakaian_sebelum"
                                        value="{{ $pemakaian_sebelum == '' ? '0' : $pemakaian_sebelum }}"
                                        placeholder="Pilih Pelanggan Terlebih Dahulu" readonly>

                                    @error('pemakaian_sebelum')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pemakaian_sekarang">Pemakaian Air</label>
                                    <input type="number" name="pemakaian_sekarang" id="pemakaian_sekarang"
                                        class="form-control @error('pemakaian_sekarang') is-invalid @enderror"
                                        min="{{ $pemakaian_sebelum == '' ? '0' : $pemakaian_sebelum }}"
                                        value="{{ $transaksi->pemakaian }}" required>
                                    @error('pemakaian')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_tagihan">Total Tagihan </label>
                                    <input type="text" name="total_tagihan_readonly" id="total_tagihan_readonly"
                                        class="form-control @error('total_tagihan') is-invalid @enderror"
                                        value="Rp. {{ number_format($transaksi->total_tagihan) }}" readonly>
                                    <input type="hidden" name="total_tagihan" value="{{ $transaksi->total_tagihan }}"
                                        id="total_tagihan" required>
                                    @error('total_tagihan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_pembayaran">Total Pembayaran </label>
                                    <input type="text" name="total_pembayaran_readonly" id="total_pembayaran_readonly"
                                        class="form-control @error('total_pembayaran') is-invalid @enderror"
                                        value="Rp. {{ number_format($transaksi->total_pembayaran) }}">
                                    <input type="hidden" name="total_pembayaran"
                                        value="{{ $transaksi->total_pembayaran }}" id="total_pembayaran">
                                    @error('total_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                                <a href="/admin/transaksi" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection