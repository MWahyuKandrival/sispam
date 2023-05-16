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
    <link rel="stylesheet" href="/assetsS/modules/select2/dist/css/select2.min.css">

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
    <script src="/assetsS/modules/select2/dist/js/select2.full.min.js"></script>

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

    //Aksi Ketika Penambahan Transaksi pada Admin saat memilih pelanggan
    $('#select_pelanggan').change(function() {
        var id = $(this).val();

        let id_petugas = $(this).find(':selected').attr('data-petugas');

        $("#select_petugas").val(`${id_petugas}`).trigger('change');

        //AJAX
        $.ajax({
            url: '/get-pemakaian/' + id,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response['pemakaian'] != null) {
                    console.log(response['pemakaian'].tanggal);
                    $("#pemakaian_sebelum").val(response['pemakaian'].pemakaian);
                    $("#pemakaian_sekarang").attr({
                        min: response['pemakaian'].pemakaian,
                    });
                    $("#total_hutang_readonly").val(formatRupiah("" + response['hutang'].hutang,
                        'Rp. '));
                    $("#total_hutang").val(response['hutang'].hutang);
                    $("#addon-tanggal-sebelum").text(response['pemakaian'].tanggal);
                } else {
                    console.log('not found');
                    $("#pemakaian_sebelum").val(0);
                    $("#pemakaian_sekarang").attr({
                        min: 0,
                    });
                    $("#total_hutang_readonly").val("Rp. 0");
                    $("#total_hutang").val("0");
                    $("#addon-tanggal-sebelum").text("Tanggal");
                }
                $("#pemakaian_sekarang").attr("readonly", false);
            },
            error: function(response) {
                swal({
                    title: 'Terjadi Kesalahan!',
                    text: 'Data Transaksi / Data Pelanggan Tidak Ditemukan, Pastikan Nama Pelanggan Benar dan Terdaftar Pada Halaman Pelanggan',
                    icon: 'error',
                });
                $("#pemakaian_sebelum").val("Pilih Pelanggan Terlebih Dahulu");
                $("#pemakaian_sekarang").val(0);
                $("#pemakaian_sekarang").attr("readonly", true);
                $("#total_hutang_readonly").val("");
                $("#total_hutang").val("");
                $("#addon-tanggal-sebelum").text("Tanggal");
            },
        });
    });

    // $("#pemakaian_sekarang").change(function() {
    //     let pemakaian = $(this).val() - $("#pemakaian_sebelum").val();
    //     var total = (parseFloat(pemakaian) * parseFloat($("#biaya_perkubik").val())) + parseFloat($("#biaya_admin").val());
    //     $("#total_tagihan_readonly").val(total)
    // });
</script>
<script type="text/javascript">
    var pakai = document.getElementById('pemakaian_sekarang');
    pakai.addEventListener('keyup', function(e) {
        if (parseInt($(this).val()) >= parseInt($(this).attr("min"))) {
            let pemakaian = $(this).val() - $("#pemakaian_sebelum").val();
            var total = (pemakaian * parseInt($("#biaya_perkubik").val())) + parseInt($(
                "#biaya_admin").val());
            $("#total_tagihan_readonly").val(formatRupiah("" + total, 'Rp. '));
            $("#total_tagihan").val(total);
            $("#total_pembayaran_readonly").attr("readonly", false);
        } else {
            $("#total_tagihan_readonly").val("");
            $("#total_tagihan").val("");
            $("#total_pembayaran_readonly").attr("readonly", true);
            $("#total_pembayaran").val("");
        }
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script>
    var pakai_update = document.getElementById('pemakaian');
    pakai_update.addEventListener('keyup', function(e) {
        let pemakaian = $(this).val();
        var total = (parseInt(pemakaian) * parseInt($("#biaya_perkubik").val())) + parseInt($(
            "#biaya_admin").val());
        console.log($(this).val());
        $("#total_tagihan_readonly").val(formatRupiah("" + total, 'Rp. '));
        $("#total_tagihan").val(total);
        $("#total_pembayaran_readonly").attr("readonly", false);
    });
</script>

<script>
    var total = document.getElementById('total_pembayaran_readonly');
    total.addEventListener('change', function(e) {
        var value = $(this).val();
        var angka = value.replace("Rp. ", "");
        var angka = angka.replace(".", "");
        var angka = angka.replace(",", "");
        $("#total_pembayaran").val(angka);
        $("#total_pembayaran_readonly").val(formatRupiah("" + $(this).val(), 'Rp. '));
    });
</script>

</html>
