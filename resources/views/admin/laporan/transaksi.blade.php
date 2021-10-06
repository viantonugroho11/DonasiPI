@extends('admin.master')

@section('scriptCss')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection

@section('scriptjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

    @if (session()-> has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif (session()-> has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>

@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi Donasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('administrator') }}">Admin</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <a href="{{ route('gallery.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">+ TAMBAH DATA</a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif --}}
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Orderid</th>
                    <th>Donasi</th>
                    <th>Pesan</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse ($transaksi as $data)
                    <tr>
                      <td>{{ $data->orderid }}</td>
                      <td>{{ $data->DnsNama }}</td>
                      <td>{{ $data->pesan }}</td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nominal }}</td>
                      <td>{{ $data->status }}</td>
                    </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data belum Tersedia.
                        </div>
                    @endforelse
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
