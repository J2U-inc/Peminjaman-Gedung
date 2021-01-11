@extends('layouts.appTemplate')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kalender Peminjaman</h1><br>

          </div><!-- /.col -->
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="card card-primary col-11">
            <div class="card-body p-0">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div><!-- /.container-fluid -->
    </div>
  </div>

  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
<script>
    var data = {!! json_encode($peminjaman->toArray()) !!};
    console.log(data);
    data = data.map(obj => {
        var tmp = {};
        tmp['title']=obj.gedung.nama_gedung;
        tmp['start']=obj.awal_pinjam;
        tmp['end']=obj.akhir_pinjam;
        tmp['allDay']=false;

        return tmp;
    })
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'Asia/Jakarta',
            themeSystem: 'bootstrap',
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

          initialView: 'dayGridMonth',
          events: data,
          timeFormat: 'H(:mm)'

        });
        calendar.render();
      });
</script>

@endpush