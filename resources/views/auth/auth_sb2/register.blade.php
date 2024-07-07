<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">

                                    <!-- First Name -->
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        {{-- <x-input-label for="name" :value="__('First Name')" /> --}}
                                        <x-text-input id="name" class="form-control form-control-user" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="First Name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <!-- First Name -->
                                    {{-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="First Name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div> --}}


                                    <!-- Last Name -->
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        {{-- <x-input-label for="name" :value="__('Last Name')" /> --}}
                                        <x-text-input id="name" class="form-control form-control-user" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Last Name"/>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <!-- Last Name -->
                                    {{-- <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div> --}}
                                </div>
                                <!-- Email Address -->
                                <div class="form-group">
                                    {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                                    <x-text-input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Address"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                {{-- <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div> --}}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                                        <x-text-input id="password" class="form-control form-control-user"
                                                        type="password"
                                                        name="password"
                                                        placeholder="Password"
                                                        required autocomplete="new-password" />
                            
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    {{-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div> --}}
                                    <div class="col-sm-6">
                                        {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

                                        <x-text-input id="password_confirmation" class="form-control form-control-user"
                                                        type="password"
                                                        name="password_confirmation" 
                                                        placeholder="Repeat Password"
                                                        required autocomplete="new-password" />
                            
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div> --}}
                                </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>