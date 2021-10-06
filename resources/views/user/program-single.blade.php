@extends('user.master')
@section('scriptcss')
<!-- PrettyPhoto -->
<link rel="stylesheet" href="{{ asset('User/css/prettyPhoto.css')}}">
@endsection

@section('scriptjs')
<!-- PrettyPhoto javascript file -->
<script src="{{ asset('User/js/jquery.prettyPhoto.js')}}"></script>
@endsection

@section('content')
<div class="text-center">

    <div class="container zoomIn animated">

        <h1 class="page-title">{{$program->nama}} <span class="title-under"></span></h1>
        <p class="page-description">
            Batas:{{$program->batas}}<br>Target:@currency($program->nominal)
        </p>

    </div>

</div>
<div class="main-container">

    <div class="container">

        <div class="row">
            <div class="col-md-12 fadeIn animated">
                {!!$program->detail!!}
            </div>

        </div>

        <div class="row fadeIn animated">
            <div class="col-md-12">
                <h2 class="title-style-2"> Form Donasi<span class="title-under"></span></h2>
                <form role="form" action="{{route('PayDonasi')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea name="pesan" class="form-control" placeholder="Pesan"></textarea>
                    </div>
                    <div class="form-group">
                       <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
                       <input type="hidden" name="id_donasi" class="form-control" value="{{$program->id}}">
                       <input type="hidden" name="nama_donasi" class="form-control" value="{{$program->nama}}">
                    </div>
                    <div class="form-group">
                        <input type="radio" class="@error('tipe') is-invalid @enderror" name="tipe" value="dompet">Dompet Kebaikan
                        <input type="radio" class="@error('tipe') is-invalid @enderror" name="tipe" value="transfer">Transfer
                        @error('tipe')
                            <br>
                                {{ $message }}
                       
                        @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Tersembunyi
                        </label>
                    </div>
                    <div class="form-group alerts">
                        <div class="alert alert-success" role="alert">
                        </div>
                        @error('tipe')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="alert alert-danger" role="alert">
                        </div>
                    </div>
                     <div class="form-group">
                        <button type="Submit" class="btn btn-block btn-primary btn-flat">
                            <i class="fas fa-save"></i> Donasi
                        </button>
                        {{-- <button type="submit" class="btn btn-submit">Ok</button> --}}
                    </div>
                </form>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12 ">
                <h2 class="title-style-2">Daftar Donatur <span class="title-under"></span></h2>
                    <table class="table table-style-1">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Pesan</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php
                          $i=1;
                          @endphp
                          @foreach ($program->getTransaksi->where('status','=','settlement') as $t)
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$t->nama}}</td>
                              <td>{{$t->pesan}}</td>
                              <td>@currency($t->nominal)</td>
                          </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                        
                            <th></th>
                            <th></th>
                            <th>Jumlah</th>
                            <th>@currency($program->getTransaksi->where('status','=','settlement')->sum('nominal'))</th>
                          </tr>
                      </tfoot>
                    </table>
            </div>
        </div>
    </div>
</div> <!-- /.main-container  -->
@endsection
