<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Peminjaman Gedung</title>
   <!-- Favicon-->
   <link rel="icon" type="image/x-icon" href="{{asset('landingPage/assets/img/logo.png')}}" />

   {{-- font awesome --}}
   <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/adminlte.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.min.css">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css"> --}}
  {{-- stisla --}}
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  {{-- calendar --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fullcalendar/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fullcalendar/interaction/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fullcalendar/daygrid/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fullcalendar/timegrid/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fullcalendar/bootstrap/main.min.css')}}"> --}}
</head>

<body>
    @yield('app')
    <!-- jQuery -->
    <script src="{{asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>

    @stack('script')

    <!-- SweetAlert2 delete -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        function deleteConfirmation(id) {
            swal({
                title: "Hapus Data?",
                text: "Apakah anda yakin akan menghapus data ?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Ya, hapus data !",
                cancelButtonText: "tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'GET',
                        url: "{{url('admin/hapusgedung')}}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                swal("Selesai !", results.message, "success");
                                setTimeout(location.reload.bind(location), 1000);
                            } else {
                                swal("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    </script>

    {{-- Date Range Picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- stisla data table --}}
    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.min.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/datatables/datatables.min.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script>
        $("#example1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": []
            }]
        });
    </script>
    <script>
        $("#datapeminjaman").dataTable({
            "columnDefs": [
                {"sortable": false, "targets": []},
                {"width" : "2%", "targets" : [0]},
                {"width" : "13%", "targets" : [1]},
                {"width" : "13%", "targets" : [2]},
                {"width" : "13%", "targets" : [3]},
                {"width" : "13%", "targets" : [4,5]},
                {"width" : "8%", "targets" : [6]},
                {"width" : "20%", "targets" : [7]}
            ]
        });
    </script>

    @stack('script')
    {{-- datetimepicker --}}
    <script>

        //change the selected date range of that picker
    </script>
</body>
</html>
