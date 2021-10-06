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
            <h1>Event Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administrator')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$event->nama}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ Storage::url('public/PhotoEvent/').$event->foto }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$event->nama}}</h3>

                {{-- <p class="text-muted text-center">ttl</p> --}}

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nama</b> <a class="float-right">{{$event->nama}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tanggal Pelaksaan</b> <a class="float-right">{{$event->tanggal_pelaksana}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Batas Pendaftaraan</b> <a class="float-right">{{$event->batas_peserta}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Jumlah Pendaftaraan</b> <a class="float-right">{{$event->getDaftarEvent->count()}}</a>
                  </li>
                </ul>

                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Pendaftar</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post clearfix">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>No Telp</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php
                          $i=1;    
                          @endphp
                        @forelse ($event->getDaftarEvent as $data)
                          <tr>
                            <td>{{ $i++ }}</td>
                            {{-- <td>{{ $data->nama }}</td> --}}
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->nohp }}</td>
                          </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection