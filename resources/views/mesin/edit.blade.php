@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Mesin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Mesin</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Mesin</h4>
                        </div>
                        <div class="card-body">
                            <form action="/admin/mesin/{{ $mesin->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="id">ID Mesin</label>
                                    <input type="text" class="form-control @error('id') is-invalid  @enderror"
                                        name="id" id="id" value="{{ $mesin->id }}">
                                    @error('id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Mesin</label>
                                    <input type="text" class="form-control @error('name') is-invalid  @enderror"
                                        name="name" id="name" value="{{ $mesin->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Mesin</label>
                                    <select name="status" id="status"
                                        class="form-control @error('status') is-invalid  @enderror">
                                        <option value="Active" {{ $mesin->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Rusak" {{ $mesin->status == 'Rusak' ? 'selected' : '' }}>Rusak
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid  @enderror"
                                        name="keterangan" id="keterangan" value="{{ $mesin->keterangan }}">
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                                <a href="/admin/mesin" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
