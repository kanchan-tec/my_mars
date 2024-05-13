@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.Login')
@endsection
<style>
    body {
        background-image: url("assets/images/bg-img.png");
       
      }

</style>
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('index') }}" class="mb-5 d-block auth-logo">
                            <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="30"
                                class="logo logo-dark">
                            <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="22"
                                class="logo logo-light">
                        </a>

                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-8 ">
                    <div class="text-center">
                       <a href="{{ route('staff.login') }}" class="btn btn-lg btn-success waves-effect waves-light" style="font-size:30px"> <b>Staff Login</b></a>
                       <br> <br> <br>
                        <a href="#" class="btn btn-lg btn-success waves-effect waves-light" style="font-size:30px"><b>Hospital Login</b></a>
                        
                    </div>


                    <div class="mt-5 text-center">
                        <b>© <script>
                                document.write(new Date().getFullYear())

                            </script> My_Mars.
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
