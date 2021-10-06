@if (Auth::check())
    <script>
    var timeout = ({{config('session.lifetime')}} * 60000) -10 ;
    setTimeout(function(){
        window.location.reload(1);
    },  timeout);



    </script>
@endif
