@extends('admin.master')

@section('scriptCss')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('Admin/plugins/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css')}}">
 <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('scriptjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('Admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- page script -->
<script src="{{ asset('Admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('Admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$(document).ready(function () {
    bsCustomFileInput.init();
  });
  $(function () {

    //note
    $('.isiArtikel').summernote()
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
            <h1>Artikel</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('administrator') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Artikel</a></li>
              <li class="breadcrumb-item active">Add Artikel</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" action="{{ route('artikel.update',$artikel->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-12">
              <!-- Produk -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Artikel</h3>
                </div>
                <div class="card-body">
                    {{-- Judul Articel --}}
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$artikel->nama) }}" placeholder="Masukan Nama Jurusan">

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
                          <option value="0">Semua Kategori</option>
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
                        <textarea class="form-control @error('detail') is-invalid @enderror" name="detail_singkat"
                          style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {{$artikel->detail_singkat}}
                        </textarea>
                        @error('detail_singkat')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    {{-- isi Artikel --}}
                    <div class="form-group">
                        <label>Detail Artikel</label>
                        <textarea class="isiArtikel @error('detail') is-invalid @enderror" name="detail"
                          style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {!! $artikel->detail !!}
                        </textarea>
                        @error('detail')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                        @enderror
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

