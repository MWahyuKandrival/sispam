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
                            <h4>Form Tambah Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <form action="/admin/pelanggan/{{ $pelanggan->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="id">ID Pelanggan</label>
                                    <input type="text" class="form-control @error('id') is-invalid  @enderror"
                                        name="id" id="id" value="{{ $pelanggan->id }}">
                                    @error('id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Pelanggan</label>
                                    <input type="text" class="form-control @error('name') is-invalid  @enderror"
                                        name="name" id="name" value="{{ $pelanggan->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Pelanggan</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid  @enderror"
                                        name="alamat" id="alamat" value="{{ $pelanggan->alamat }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">Nomor Telephone</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid  @enderror"
                                        name="no_telp" id="no_telp" value="{{ $pelanggan->no_telp }}">
                                    @error('no_telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Petugas</label>
                                    <select name="status" id="status"
                                        class="form-control @error('status') is-invalid  @enderror">
                                        <option value="Active" {{ $pelanggan->status == "Active" ? 'selected' : '' }}>Active</option>
                                        <option value="Non-Active" {{ $pelanggan->status == "Non-Active" ? 'selected' : '' }}>Non-Active</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kode_mesin">Kode Mesin</label>
                                    <select name="kode_mesin" id="kode_mesin"
                                        class="form-control @error('kode_mesin') is-invalid  @enderror">
                                        @forelse ($mesin as $ms)
                                            <option value="{{ $ms->kode_mesin }}" {{ $pelanggan->kode_mesin == $ms->kode_mesin ? 'selected' : '' }}>{{ $ms->name }}</option>
                                        @empty
                                            <option value="">Tidak ada Mesin yang Terdaftar</option>
                                        @endforelse
                                    </select>
                                    @error('kode_mesin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="id_user">Petugas</label>
                                    <select name="id_user" id="id_user"
                                        class="form-control @error('id_user') is-invalid  @enderror">
                                        @forelse ($petugas as $ms)
                                            <option value="{{ $ms->id }}" {{ $pelanggan->id_user == $ms->id_user ? 'selected' : '' }}>{{ $ms->name }}</option>
                                        @empty
                                            <option value="">Tidak ada Petugas yang Terdaftar</option>
                                        @endforelse
                                    </select>
                                    @error('id_user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                                <a href="/admin/pelanggan" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
