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
                        @if (session()->has('success'))
                            <div class="row d-flex justify-content-center">
                                <div class="alert alert-success col-lg-8" role="alert">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="row d-flex justify-content-center">
                                <div class="alert alert-danger col-lg-8" role="alert">
                                    {{ session('error') }}
                                </div>
                            </div>
                        @endif
                        <div class="card-header d-flex">
                            <div class="dflex-right">
                                <div class="buttons">
                                    <a href="/admin/petugas/create" class="btn btn-primary">Tambah Petugas</a>
                                </div>
                            </div>
                            {{-- <h4>Basic DataTables</h4> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama</th>
                                            <th>Jumlah <br />Pelanggan</th>
                                            <th>Tagihan</th>
                                            <th>Total Tagihan</th>
                                            <th>Total Pembayaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($petugas as $ptg)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $ptg->name }}</td>
                                                <td>{{ $ptg->pelanggan->count() }}</td>
                                                <td>{{ $ptg->currentPemakaian->count() }} / {{ $ptg->pelanggan->count() }}
                                                </td>
                                                <td>Rp. {{ number_format($ptg->currentPemakaian->sum('total_tagihan')) }}
                                                </td>
                                                <td>Rp. {{ number_format($ptg->currentPemakaian->sum('total_pembayaran')) }}
                                                </td>
                                                <td>{{ $ptg->status }}</td>
                                                <td>
                                                    <a href="/admin/petugas/{{ $ptg->id }}"><button
                                                            class="btn btn-primary" style="width: 6em">Detail</button></a>
                                                    <a href="/admin/petugas/{{ $ptg->id }}/edit"><button
                                                            class="btn btn-warning" style="width: 6em">Edit</button></a>
                                                    @if ($ptg->role != 'Admin')
                                                        <form action="/admin/petugas/{{ $ptg->id }}" method="POST"
                                                            id="deleteForm_{{ $loop->iteration }}"
                                                            style="display: inline;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-delete"
                                                                data-loop="{{ $loop->iteration }}"
                                                                data-name="{{ $ptg->name }}"
                                                                style="width: 6em; display: inline-block;">Delete</button>
                                                        </form>
                                                    @endif
                                                    {{-- <a href="/admin/petugas/atur-pelanggan/{{ $ptg->id }}"><button
                                                        class=" btn btn-success" style="width: 10em">Atur Pelanggan</button></a> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data Petugas</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
