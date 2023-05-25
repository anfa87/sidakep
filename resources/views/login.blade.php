<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDAKEP - Login</title>
    <!-- style untuk halaman ini -->
    <link rel="stylesheet" href="/css/style-login.css">
    <!-- sb-admin css-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-page">
      @if (session('sukses'))
                    
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('sukses') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
      @if (session()->has('gagal'))
                    
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('gagal') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
      <div class="form">
        
        <form method="POST" action="" class="login-form">
          @csrf
          <input type="text" name="username" placeholder="username"/>
          <input type="password" name="password" placeholder="password"/>
          <button>login</button>
          <p class="message">Belum registrasi? <a href="/register">Klik untuk registrasi!</a></p>
        </form>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
   <script src="/vendor/jquery/jquery.min.js"></script>
   <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
</html>

