@extends('admin.master')

@section('scriptCss')
 <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('scriptjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- page script -->
<script src="{{ asset('Admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('administrator') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
              <li class="breadcrumb-item active">Kategori</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <!-- Produk -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Kategori</h3>
                </div>
                <div class="card-body">
                      <!-- Jurusan -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama Jurusan">

                        @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                      <!-- /.form group -->
                      {{-- jenis --}}
                    {{-- selesai jenis --}}
                    {{-- upload Gambar --}}
                    <div class="form-group">
                        <label for="exampleInputFile">Icon</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="icon" class="custom-file-input @error('foto_sampul') is-invalid @enderror" id="exampleInputFile">
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
                          <i class="fas fa-cancel"></i> Cancel
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

