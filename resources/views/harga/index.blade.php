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
                        <div class="card-header">
                            <h4>List Harga</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Harga</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($harga as $ptg)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $ptg->nama_harga }}</td>
                                                <td>Rp. {{ number_format($ptg->harga) }}
                                                <td>{{ $ptg->keterangan }}</td>
                                                <td>
                                                    <a href="/admin/harga/{{ $ptg->id }}/edit"><button
                                                            class="btn btn-warning" style="width: 6em">Edit</button></a>
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
