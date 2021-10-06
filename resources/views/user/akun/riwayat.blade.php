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

        <h1 class="page-title">Riwayat Donasi<span class="title-under"></span></h1>
        <p class="page-description">

        </p>

    </div>

</div>
<div class="main-container">

    <div class="container">

        <div class="row ">
            <div class="col-md-12 ">
                <h2 class="title-style-2">Riwayat Transaksi<span class="title-under"></span></h2>
                    <table class="table table-style-1">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>OrderID</th>
                          {{-- <th>Nama</th> --}}
                          <th>Status</th>
                          <th>Tipe</th>
                          <th>Tanggal</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php
                          $i=1;
                          @endphp
                          @foreach ($riwayat as $item)
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$item->orderid}}</td>
                              {{-- <td>{{$item->PrgNama}}</td> --}}
                              <td>{{$item->status}}</td>
                              <td>{{$item->tipe}}</td>
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
                    {!! $riwayat->links("pagination::bootstrap-4") !!}
                    </center>
                </div>
                <div class="col-md-3 col-sm-3">
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.main-container  -->
@endsection
