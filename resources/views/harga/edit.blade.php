@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Harga</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Harga</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Harga</h4>
                        </div>
                        <div class="card-body">
                            <form action="/admin/harga/{{ $harga->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nama_harga">Nama Harga</label>
                                    <input type="text" class="form-control @error('nama_harga') is-invalid  @enderror"
                                        name="nama_harga" id="nama_harga" value="{{ $harga->nama_harga }}" readonly>
                                    @error('nama_harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                <label for="harga">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid  @enderror"
                                        name="harga" id="harga" value="{{ $harga->harga }}">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid  @enderror"
                                        name="keterangan" id="keterangan" value="{{ $harga->keterangan }}">
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="/admin/harga" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
