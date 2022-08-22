@extends('v_admin_master.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>Daftar Reservasi</b></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('admin-master/reservasi') }}">Daftar Reservasi</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p class="fw-light" style="margin: auto;">{{ $message }}</p>
    </div>
    @endif
    @if ($message = Session::get('failed'))
    <div class="alert alert-danger">
      <p class="fw-light" style="margin: auto;">{{ $message }}</p>
    </div>
    @endif
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><b>Daftar Reservasi Kamar</b></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table-1" class="table table-bordered table-striped responsive">
          <thead class="text-center">
            <tr>
              <th style="width: 5%;">No</th>
              <th style="width: 10%;">Kode Biling</th>
              <th style="width: 15%;">Nama Pengunjung</th>
              <th style="width: 15%;">Check In - Check Out</th>
              <th style="width: 10%;">Durasi</th>
              <th style="width: 11%;">Kamar</th>
              <th style="width: 10%">Harga</th>
              <th style="width: 10%">Status</th>
            </tr>
          </thead>
          <?php $no = 1; ?>
          <tbody class="text-capitalize text-center">
            @foreach($reservasi as $reservasi)
            <tr>
              <td class="pt-3">{{ $no++ }}</td>
              <td class="pt-3">{{ $reservasi->billing_code }}</td>
              <td class="pt-3">{{ $reservasi->visitor_name }}</td>
              <td class="pt-3">
                {{ \Carbon\Carbon::parse($reservasi->check_in)->isoFormat('DD/MM/YY') }} - {{ \Carbon\Carbon::parse($reservasi->check_out)->isoFormat('DD/MM/YY') }}
              </td>
              <td class="pt-3">{{ $reservasi->duration }} malam</td>
              <td class="pt-3">{{ $reservasi->room_name }}</td>
              <td class="pt-3">Rp {{ number_format($reservasi->detail_reservation_price, 0, ',', '.') }}</td>
              <td class="pt-3" >
                @if($reservasi->status_reservation == 'payment')
                <p>Menunggu Pembayaran</p>
                @elseif($reservasi->status_reservation == 'reserved')
                <p>Dipesan</p>
                @elseif($reservasi->status_reservation == 'checkin')
                <p>Check In</p>
                @elseif($reservasi->status_reservation == 'checkout')
                <p>Check Out</p>
                @else
                <p>Batal</p>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</section>
<!-- End Main Content -->
@section('js')
<script>
  $(function () {
    $("#table-1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel","pdf"]
    }).buttons().container().appendTo('#table-1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection

@endsection