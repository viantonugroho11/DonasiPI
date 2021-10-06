<footer class="main-footer">
    <div class="footer-top">
    </div>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-4">
                    <div class="footer-col">
                        <h4 class="footer-title">About us <span class="title-under"></span></h4>
                        <div class="footer-content">
                            <p>
                                <strong>Sadaka</strong> ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                            </p>
                            <p>
                                ILorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                            </p>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4 class="footer-title">Artikel <span class="title-under"></span></h4>

                        <div class="footer-content">
                            <ul class="tweets list-unstyled">
                                @foreach ($artikel as $item)
                                <li class="tweet">
                                    {!!Str::limit($item->detail_singkat,50,'...')!!}  <a href="{{route('artikeluser.show',$item->id)}}">Lihat Detail</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4 class="footer-title">NewsLetter<span class="title-under"></span></h4>
                        <div class="footer-content">
                            <div class="footer-form">
                                <div class="footer-form" >
                                <form action="{{route('newsuser')}}" method="POST">
                                    @csrf
                                     <div class="form-group">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" required>
                                        @error('email')
                                            
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group alerts">
                                        <div class="alert alert-success" role="alert">
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <button type="submit" class="btn btn-submit pull-right">OK</button>
                                    </div>
                                </form>
                                @if (session()-> has('success'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        {{-- ('{{ session('success') }}', 'BERHASIL!'); --}}
                                @elseif (session()-> has('error'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>Email Anda Tidak Tersedia</strong>
                                        </span>
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4 class="footer-title">Contact us <span class="title-under"></span></h4>
                        <div class="footer-content">
                            <div class="footer-form">
                                <div class="footer-form" >
                                <form action="php/mail.php" class="ajax-form">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    </div>
                                     <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                                    </div>
                                    <div class="form-group alerts">
                                        <div class="alert alert-success" role="alert">
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <button type="submit" class="btn btn-submit pull-right">Send message</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container text-right">
            {{-- Sadaka @ copyrights 2015 - by <a href="http://www.ouarmedia.com" target="_blank">Ouarmedia</a> --}}
        </div>
    </div>
</footer> <!-- main-footer -->
