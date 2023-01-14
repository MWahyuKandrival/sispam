<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard - SISPAM</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assetsS/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assetsS/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assetsS/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="/assetsS/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assetsS/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="/assetsS/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/assetsS/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/assetsS/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/assetsS/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assetsS/css/style.css">
    <link rel="stylesheet" href="/assetsS/css/components.css">

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            {{-- Include Navbar --}}
            <div class="navbar-bg"></div>
            @include('partials.navbar')

            {{-- Include Sidebar --}}
            @include('partials.sidebar')

            <!-- Main Content -->
            {{-- Include Main --}}
            <div class="main-content">
                @yield('container')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/assetsS/modules/jquery.min.js"></script>
    <script src="/assetsS/modules/popper.js"></script>
    <script src="/assetsS/modules/tooltip.js"></script>
    <script src="/assetsS/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assetsS/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assetsS/modules/moment.min.js"></script>
    <script src="/assetsS/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="/assetsS/modules/datatables/datatables.min.js"></script>
    <script src="/assetsS/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assetsS/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="/assetsS/modules/jquery.sparkline.min.js"></script>
    <script src="/assetsS/modules/chart.min.js"></script>
    <script src="/assetsS/modules/sweetalert/sweetalert.min.js"></script>
    <script src="/assetsS/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="/assetsS/modules/summernote/summernote-bs4.js"></script>
    <script src="/assetsS/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="/assetsS/js/page/index.js"></script> --}}
    <script src="/assetsS/js/page/modules-datatables.js"></script>
    <script src="/assetsS/js/page/modules-sweetalert.js"></script>

    <!-- Template JS File -->
    <script src="/assetsS/js/scripts.js"></script>
    <script src="/assetsS/js/custom.js"></script>


</body>

<script>
    //Delete button 
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let loop = $(this).data('loop');
        let name = $(this).data('name');
        // alert(name);
        swal({
                title: 'Hapus ' + name + '?',
                text: 'Sekali dihapus, kamu tidak akan bisa mengembalikan data ini kembali!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal('Berhasil menghapus Data', {
                        icon: 'success',
                    }).then((showNotif) => {
                        $(`#deleteForm_${loop}`).submit();
                    });
                } else {
                    swal('Data tidak jadi dihapus!');
                }
            });
    });
</script>

</html>
