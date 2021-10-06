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
@include('user.tools.header1')

  <div class="section-home our-causes">

      <div class="container">

          <h2 class="title-style-1">Artikel<span class="title-under"></span></h2>
          <div class="row">
            <div class="col-md-2 col-sm-2">
              <form role="form" action="{{route('artikeluser.kategori')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                        <select class="form-control" style="width: 100%" name="kategori">
                          <option value="all">--Pilih Semua--</option>
                        @forelse($kategori1 as $data)
                          <option value="{{$data->id}}">{{$data->nama}}</option>
                        @empty
                          <option value="null">Data Tidak Tersedia</option>
                        @endforelse
                    </select>
                </div>
                 <div class="form-group">
                    <button type="Submit" class="btn btn-block btn-primary btn-flat">
                      Filter
                    </button>
                    {{-- <button type="submit" class="btn btn-submit">Ok</button> --}}
                </div>
              </form>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="row">
                  @foreach ($artikel1 as $item)              
                  <div class="col-md-3 col-sm-6">
                    <div class="cause">
                        <img src="{{ Storage::url('public/PhotoArtikel/').$item->foto }}" alt="" class="cause-img">
                        <h4 class="cause-title" style="min-height: 40px; max-height: 40px"><a href="#">{{$item->nama}} </a></h4>
                        <div class="cause-details">
                          <div style="min-height: 75px">
                            {{ Str::limit($item->detail_singkat,50,'...')}}
                          </div>
                          <hr>
                            Editor : {{$item->AdmNama}}<br>
                            Tanggal : {{$item->created_at}}
                        </div>
                        <div class="btn-holder text-center">
                          <a href="{{route('artikeluser.show',$item->id.$item->nama,)}}" class="btn btn-primary">Detail</a>
                        </div>
                    </div> <!-- /.cause -->
                  </div>
                  @endforeach
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-3 col-sm-3">
                </div>
                <div class="col-md-6 col-sm-6">
                    <center>
                    {!! $artikel1->links("pagination::bootstrap-4") !!}
                    </center>
                </div>
                <div class="col-md-3 col-sm-3">
                </div>
            </div>
        </div>
      </div>
  </div> <!-- /.our-causes -->
@endsection
