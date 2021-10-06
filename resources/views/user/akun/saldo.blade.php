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

        <h1 class="page-title">Saldo Kebaikan<span class="title-under"></span></h1>
        <p class="page-description">

        </p>

    </div>

</div>
<div class="main-container">

    <div class="container">

        <div class="row fadeIn animated">
            <div class="col-md-12">
                <h2 class="title-style-2"><span class="title-under"></span></h2>
                <form role="form" action="{{route('SaldoPay')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                       <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
                    </div>
                    <div class="form-group alerts">
                        <div class="alert alert-success" role="alert">
                        </div>
                        <div class="alert alert-danger" role="alert">
                        </div>
                    </div>
                     <div class="form-group">
                        <button type="Submit" class="btn btn-block btn-primary btn-flat">
                            <i class="fas fa-save"></i>Klik
                        </button>
                        {{-- <button type="submit" class="btn btn-submit">Ok</button> --}}
                    </div>
                </form>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12 ">
                <h2 class="title-style-2">Riwayat Transaksi<span class="title-under"></span></h2>
                    <table class="table table-style-1">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Status</th>
                          <th>Tanggal</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php
                          $i=1;
                          @endphp
                          @foreach ($saldo as $item)
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$item->nama}}</td>
                              <td>{{$item->status}}</td>
                              <td>{{$item->updated_at}}</td>
                              <td>@currency($item->nominal)</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-3 col-sm-3">
                </div>
                <div class="col-md-6 col-sm-6">
                    <center>
                    {!! $saldo->links("pagination::bootstrap-4") !!}
                    </center>
                </div>
                <div class="col-md-3 col-sm-3">
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.main-container  -->
@endsection
