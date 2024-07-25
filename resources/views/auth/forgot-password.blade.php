@extends('layout.auth.app',[
    'title' => 'Forgot Password'
])
@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                <p class="mb-4">We get it, Don't Panic and Please Contact Your Supervisor, Then We Can Reset Your Password</p>
                            </div>
                            <form class="user">
                                <!-- <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address...">
                                </div> -->
                                <a href="{{ route('login') }}" class="btn btn-primary btn-user btn-block">
                                    Back To Login
                                </a>
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                {{-- <a class="small" href="{{ route('register') }}">Create an Account!</a> --}}
                            </div> -->
                            <!-- <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@stop