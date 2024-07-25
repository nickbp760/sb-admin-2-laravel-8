<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-4/css/bootstrap.min.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">WELCOME ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      	@auth
      		<a class="nav-link" href="{{ route('admin') }}">Dashboard</a>
      	@else
      		<a class="nav-link" href="{{ route('login') }}">Login</a>
      	@endauth
      </li>
    </ul>
    <span class="navbar-text">

    </span>
  </div>
</nav>

<div class="container-fluid mt-5">
	
	<div class="jumbotron">
    @guest
    <h1 class="display-4">Selamat Datang di ADMIN DASHBOARD</h1>
    @endguest

    @auth
    <h1 class="display-4">Hello , {{ Auth::user()->name }}</h1>
    @endauth
    
    <!-- <p class="lead">WELCOME ADMIN adalah simpel starter sb-admin-2 untuk laravel, keuntungannya adalah kita tidak harus mengintegrasikan sb-admin-2 dari awal.</p> -->
	  <hr class="my-4">

    <div class="row">

      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">List Fitur</div>
          <div class="card-body">
            <ul>
              <li>Management User</li>
              <li>Autorisasi Admin</li>
              <li>Compatible UI/UX</li>
            </ul>

          </div>
        </div>
      </div>

    </div>
  </div>

</div>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-4/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-4/js/bootstrap.min.js') }}"></script>
</body>
</html>