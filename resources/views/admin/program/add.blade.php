@extends('admin.master')

@section('scriptCss')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('Admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css')}}">
 <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  {{-- datetime --}}
  <link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('scriptjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('Admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- page script -->
<script src="{{ asset('Admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('Admin/plugins/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(document).ready(function () {
    bsCustomFileInput.init();
  });
  $(function () {

    //note
    $('.isiArtikel').summernote()
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
  })
</script>

@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Program</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('administrator') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
              <li class="breadcrumb-item active">Add Program</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <!-- Produk -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Program</h3>
                </div>
                <div class="card-body">
                    {{-- Judul Program --}}
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama Jurusan">

                        @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- Kategori --}}
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" style="width: 100%" name="kategori">
                        
                          @forelse($kategori as $data)
                          <option value="{{$data->id}}">{{$data->nama}}</option>
                        @empty
                          <option value=""> Data Tidak Tersedia</option>
                        @endforelse
                        </select>
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label>Detail Singkat</label>
                        <textarea class="form-control @error('detail_singkat') is-invalid @enderror" name="detail_singkat"
                          style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        @error('detail_singkat')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    {{-- isi Detail --}}
                    <div class="form-group">
                        <label>Detail Program</label>
                        <textarea class="isiArtikel @error('detail') is-invalid @enderror" name="detail"
                          style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        @error('detail')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    {{-- Nominal Program --}}
                    <div class="form-group">
                        <label>Target Nominal</label>
                        <input name="nominal" type="number" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" placeholder="Masukan Nominal">

                        @error('nominal')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- Target Tanggal --}}
                    <div class="form-group">
                        <label>Batas Tanggal</label>
                        <input name="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" placeholder="Masukan Nominal">
                    </div>
                    {{-- Upload Gambar --}}
                    <div class="form-group">
                        <label for="exampleInputFile">Foto Sampul</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="foto_sampul" class="custom-file-input @error('foto_sampul') is-invalid @enderror" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                        </div>
                        @error('foto_sampul')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-6">
                      <button type="Submit" class="btn btn-block btn-primary btn-flat">
                          <i class="fas fa-save"></i> Save
                      </button>
                  </div>
                  <div class="col-md-6">
                      <button type="Reset" class="btn btn-block btn-primary btn-flat">
                          <i class="fas fa-cancel"></i> cancel
                      </button>
                  </div>
              </div>
              </div>
          </div>
          <!-- /.row -->
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
