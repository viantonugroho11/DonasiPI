@extends('admin.master')


@section('scriptjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- DataTables -->
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administrator')}}">Home</a></li>
              <li class="breadcrumb-item active">{{Auth::User()->name}}</li>
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
                </div>

                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                {{-- <p class="text-muted text-center">ttl</p> --}}

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nama</b> <a class="float-right">{{Auth::user()->name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{Auth::user()->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Role</b> <a class="float-right">{{Auth::user()->role}}</a>
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
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Update</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post clearfix">
                      <form role="form" action="{{ route('profiladmin.update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                          <div class="col-md-12">
                            <!-- Produk -->
                            <div class="card card-info">
                              <div class="card-header">
                                {{-- <h3 class="card-title">Program</h3> --}}
                              </div>
                              <div class="card-body">
                                  {{-- Judul Program --}}
                                  <div class="form-group">
                                      <label>Nama</label>
                                      <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',Auth::user()->name) }}" placeholder="Masukan Nama Jurusan">
                                  
                                      @error('nama')
                                          <div class="alert alert-danger mt-2">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  {{-- Nominal Program --}}
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}" readonly placeholder="Masukan Nominal">
                                  
                                      @error('email')
                                          <div class="alert alert-danger mt-2">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label>Password</label>
                                      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan Password">
                                  
                                      @error('password')
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