@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Client</h4>
                            </div>
                            <div class="card-body">
                                {{ count($pelanggan) }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Client Aktif</h4>
                            </div>
                            <div class="card-body">
                                {{ count($pelanggan->where('status', 'Active')) }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-circle"></i>
                        </div>

                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Client Berakhir</h4>
                            </div>
                            <div class="card-body">
                                {{ count($pelanggan->where('status','!=',  'Active')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
