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
                            <h4>Form Detail Petugas</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID Petugas</label>
                                <input type="text" class="form-control" name="id" id="id"
                                    value="{{ $petugas->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Petugas</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $petugas->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role Petugas</label>
                                <input type="text" class="form-control" name="role" id="role"
                                    value="{{ $petugas->role }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Petugas</label>
                                <input type="text" class="form-control" name="status" id="status"
                                    value="{{ $petugas->status }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Detail Petugas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nama Petugas</th>
                                            <th>Total Tagihan</th>
                                            <th>Bayar Tagihan</th>
                                            <th>Hutang</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($petugas->pelanggan as $ptg)
                                            <tr>
                                                {{-- {{ dd($ptg->petugas->name) }} --}}
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $ptg->name }}</td>
                                                <td>{{ !empty($ptg->petugas) ? $ptg->petugas->name : '-' }}</td>
                                                <td>Rp. {{ number_format($ptg->currentTransaksi->sum('total_tagihan')) }}
                                                </td>
                                                <td>Rp. {{ number_format($ptg->currentTransaksi->sum('total_pembayaran')) }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($ptg->currentTransaksi->sum('total_pembayaran') - $ptg->currentTransaksi->sum('total_tagihan')) }}
                                                </td>
                                                <td>{{ $ptg->status }}</td>
                                                <td>
                                                    <a href="/admin/pelanggan/{{ $ptg->id }}"><button
                                                            class="btn btn-primary" style="width: 6em">Detail</button></a>
                                                    <a href="/admin/pelanggan/{{ $ptg->id }}/edit"><button
                                                            class="btn btn-warning" style="width: 6em">Edit</button></a>
                                                    <form action="/admin/pelanggan/{{ $ptg->id }}" method="POST"
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
