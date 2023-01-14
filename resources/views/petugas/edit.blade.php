@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Petugas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Petugas</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Petugas</h4>
                        </div>
                        <div class="card-body">
                            <form action="/admin/petugas/{{ $petugas->id }}" method="POST">
                                @csrf
                                @method("put")
                                <div class="form-group">
                                    <label for="id">ID Petugas</label>
                                    <input type="text" class="form-control @error('id') is-invalid  @enderror"
                                        name="id" id="id" value="{{ $petugas->id }}">
                                    @error('id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Petugas</label>
                                    <input type="text" class="form-control @error('name') is-invalid  @enderror"
                                        name="name" id="name" value="{{ $petugas->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid  @enderror"
                                        name="password" id="password" value="{{ $petugas->password }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role">Role Petugas</label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid  @enderror">
                                        <option value="Petugas">Petugas</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Petugas</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid  @enderror">
                                        <option value="Active">Active</option>
                                        <option value="Non-Active">Non-Active</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                                <a href="/admin/petugas" class="btn btn-warning">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
