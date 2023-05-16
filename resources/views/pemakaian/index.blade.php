@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Pemakaian Bulanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Pemakaian</div>
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
                                    @if (auth()->user()->role === 'Admin')
                                        <a href="/admin/pemakaian/create" class="btn btn-primary">Tambah Pemakaian</a>
                                    @else
                                        <a href="/petugas/pemakaian/create" class="btn btn-primary">Tambah Pemakaian</a>
                                    @endif
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
                                            <th>Tanggal Pemakaian</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nama Petugas</th>
                                            <th>Total Tagihan</th>
                                            <th>Bayar Tagihan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pemakaian as $ptg)
                                            <tr>
                                                {{-- {{ dd($ptg->petugas->name) }} --}}
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $ptg->tanggal }}</td>
                                                <td>{{ $ptg->pelanggan->name }}</td>
                                                <td>{{ !empty($ptg->petugas) ? $ptg->petugas->name : '-' }}</td>
                                                <td>Rp. {{ number_format($ptg->total_tagihan) }}
                                                </td>
                                                <td>Rp. {{ number_format($ptg->total_pembayaran) }}
                                                </td>
                                                <td>{{ $ptg->status }}</td>
                                                <td>
                                                    <a href="/admin/transaksi/{{ $ptg->id_transaksi }}"><button
                                                            class="btn btn-primary" style="width: 6em">Detail</button></a>
                                                    <a href="/admin/transaksi/{{ $ptg->id_transaksi }}/edit"><button
                                                            class="btn btn-warning" style="width: 6em">Edit</button></a>
                                                    <form action="/admin/transaksi/{{ $ptg->id_transaksi }}" method="POST"
                                                        id="deleteForm_{{ $loop->iteration }}" style="display: inline;">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-delete"
                                                            data-loop="{{ $loop->iteration }}"
                                                            data-name="{{ $ptg->name }}"
                                                            style="width: 6em; display: inline-block;">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data Transaksi</td>
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
