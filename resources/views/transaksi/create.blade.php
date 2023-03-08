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
                            <h4>Form Tambah Transaksi</h4>
                        </div>
                        @if (auth()->user()->role === 'Admin')
                            <div class="card-body">
                                <form action="/admin/transaksi" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="id_pelanggan">Nama Pelanggan</label>
                                        <select class="form-control @error('id_pelanggan') is-invalid  @enderror select2"
                                            name="id_pelanggan" id="select_pelanggan">
                                            <option value="">Silahkan Pilih Pelanggan</option>
                                            @forelse ($pelanggan as $s)
                                                <option value="{{ $s->id }}" data-petugas="{{ $s->id_user }}"
                                                    @if (old('id_pelanggan') == $s->id) selected="selected" @endif>
                                                    {{ $s->name }} - {{ $s->id }}
                                                </option>
                                            @empty
                                                <option value="">Tidak Ada Data Pelanggan</option>
                                            @endforelse
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_user">Nama Petugas</label>
                                        <select class="form-control @error('id_user') is-invalid  @enderror select2"
                                            name="id_user" id="select_petugas">
                                            <option value="">Silahkan Pilih Pelanggan Terlebih Dahulu</option>
                                            @forelse ($petugas as $s)
                                                <option value="{{ $s->id }}"
                                                    @if (old('id_user') == $s->id) selected="selected" @endif>
                                                    {{ $s->name }} - {{ $s->id }}
                                                </option>
                                            @empty
                                                <option value="">Tidak Ada Data Petugas</option>
                                            @endforelse
                                        </select>
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
                                            value="Rp. {{ number_format($harga[0]->harga) }}" readonly>
                                        <input type="hidden" name="biaya_perkubik" id="biaya_perkubik"
                                            value="{{ $harga[0]->harga }}">
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
                                            value="Rp. {{ number_format($harga[1]->harga) }}" readonly>
                                        <input type="hidden" name="biaya_admin" id="biaya_admin"
                                            value="{{ $harga[1]->harga }}">
                                        @error('biaya_admin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pemakaian_sebelum">Pemakaian Air Bulan Sebelumnya</label>
                                        <input type="text" class="form-control" id="pemakaian_sebelum"
                                            name="pemakaian_sebelum" value="{{ old('pemakaian_sebelum') }}"
                                            placeholder="Pilih Pelanggan Terlebih Dahulu" readonly>

                                        @error('pemakaian_sebelum')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pemakaian_sekarang">Pemakaian Air Bulan Sekarang </label>
                                        <input type="number" name="pemakaian_sekarang" id="pemakaian_sekarang"
                                            class="form-control @error('pemakaian_sekarang') is-invalid @enderror"
                                            min="{{ old('pemakaian_sekarang') }}" value="{{ old('pemakaian_sekarang') }}"
                                            required>
                                        @error('pemakaian_sekarang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_tagihan">Total Tagihan </label>
                                        <input type="text" name="total_tagihan_readonly" id="total_tagihan_readonly"
                                            class="form-control @error('total_tagihan') is-invalid @enderror"
                                            value="Rp. {{ number_format(old('total_tagihan')) }}" readonly>
                                        <input type="hidden" name="total_tagihan" value="{{ old('total_tagihan') }}"
                                            id="total_tagihan" required>
                                        @error('total_tagihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran </label>
                                        <input type="text" name="total_pembayaran_readonly"
                                            id="total_pembayaran_readonly"
                                            class="form-control @error('total_pembayaran') is-invalid @enderror"
                                            value="{{ old('total_pembayaran_readonly') }}" required>
                                        <input type="hidden" name="total_pembayaran" value="{{ old('total_pembayaran') }}"
                                            id="total_pembayaran">
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
                        @else
                            <div class="card-body">
                                <form action="/petugas/transaksi" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="id_pelanggan">Nama Pelanggan</label>
                                        <select class="form-control @error('id_pelanggan') is-invalid  @enderror select2"
                                            name="id_pelanggan" id="select_pelanggan">
                                            <option value="">Silahkan Pilih Pelanggan</option>
                                            @forelse ($pelanggan as $s)
                                                <option value="{{ $s->id }}" data-petugas="{{ $s->id_user }}"
                                                    @if (old('id_pelanggan') == $s->id) selected="selected" @endif>
                                                    {{ $s->name }} - {{ $s->id }}
                                                </option>
                                            @empty
                                                <option value="">Tidak Ada Data Pelanggan</option>
                                            @endforelse
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_user">Nama Petugas</label>
                                        <select class="form-control @error('id_user') is-invalid  @enderror select2"
                                            name="id_user" id="select_petugas">
                                            <option value="">Silahkan Pilih Pelanggan Terlebih Dahulu</option>
                                            @forelse ($petugas as $s)
                                                <option value="{{ $s->id }}"
                                                    @if (old('id_user') == $s->id) selected="selected" @endif>
                                                    {{ $s->name }} - {{ $s->id }}
                                                </option>
                                            @empty
                                                <option value="">Tidak Ada Data Petugas</option>
                                            @endforelse
                                        </select>
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
                                            value="Rp. {{ number_format($harga[0]->harga) }}" readonly>
                                        <input type="hidden" name="biaya_perkubik" id="biaya_perkubik"
                                            value="{{ $harga[0]->harga }}">
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
                                            value="Rp. {{ number_format($harga[1]->harga) }}" readonly>
                                        <input type="hidden" name="biaya_admin" id="biaya_admin"
                                            value="{{ $harga[1]->harga }}">
                                        @error('biaya_admin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pemakaian_sebelum">Pemakaian Air Bulan Sebelumnya</label>
                                        <input type="text" class="form-control" id="pemakaian_sebelum"
                                            name="pemakaian_sebelum" value="{{ old('pemakaian_sebelum') }}"
                                            placeholder="Pilih Pelanggan Terlebih Dahulu" readonly>

                                        @error('pemakaian_sebelum')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pemakaian_sekarang">Pemakaian Air Bulan Sekarang </label>
                                        <input type="number" name="pemakaian_sekarang" id="pemakaian_sekarang"
                                            class="form-control @error('pemakaian_sekarang') is-invalid @enderror"
                                            min="{{ old('pemakaian_sekarang') }}"
                                            value="{{ old('pemakaian_sekarang') }}" required>
                                        @error('pemakaian_sekarang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_tagihan">Total Tagihan </label>
                                        <input type="text" name="total_tagihan_readonly" id="total_tagihan_readonly"
                                            class="form-control @error('total_tagihan') is-invalid @enderror"
                                            value="Rp. {{ number_format(old('total_tagihan')) }}" readonly>
                                        <input type="hidden" name="total_tagihan" value="{{ old('total_tagihan') }}"
                                            id="total_tagihan" required>
                                        @error('total_tagihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran </label>
                                        <input type="text" name="total_pembayaran_readonly"
                                            id="total_pembayaran_readonly"
                                            class="form-control @error('total_pembayaran') is-invalid @enderror"
                                            value="{{ old('total_pembayaran_readonly') }}" required>
                                        <input type="hidden" name="total_pembayaran"
                                            value="{{ old('total_pembayaran') }}" id="total_pembayaran">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
