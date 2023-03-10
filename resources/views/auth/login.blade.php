@extends('layouts.loginmain')

@section('login')
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ session('loginError') }}
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <form method="POST" action="/login" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="id">ID User</label>
                                        <input id="id" type="text" class="form-control" name="id"
                                            tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Masukkan ID User
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Masukkan Password
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="checkbox" name="remember">
                                        <label for="remember">Remember me</label>
                                  </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
