<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Registrar Usuario - MGMBIT</title>


    <!-- Bootstrap core CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

       <!-- Custom fonts for this template--> 
    <link href="resourse/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      html,
		body {
		  height: 100%;
		}

		body {
		  display: -ms-flexbox;
		  display: flex;
		  -ms-flex-align: center;
		  align-items: center;
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #f5f5f5;
		}
		.sidebar-sticky {
          /*background: gray;*/
          background-image: url("resourse/img/bussiness.jpg") !important;
          background-size: cover;
          background-position: center center;
          background-repeat: no-repeat;
          position: relative;
      	}

		.form-signin {
		  width: 100%;
		  max-width: 330px;
		  padding: 15px;
		  margin: auto;
		  box-shadow: 0 30px 60px 0 rgba(50, 5, 5, 0.3);
		}
		.form-signin .checkbox {
		  font-weight: 400;
		}
		.form-signin .form-control {
		  position: relative;
		  box-sizing: border-box;
		  height: auto;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="email"] {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
    </style>
    <!-- Custom styles for this template --> 
  </head>
  <body class="text-center animate__animated animate__fadeInDownBig animate__delay-1s sidebar-sticky ">
    <form class="form-signin">
	  <img class="mb-4" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/Echo_edit-user-talk_icon.svg/1024px-Echo_edit-user-talk_icon.svg.png" alt="" width="72" height="72">
	  <h1 class="h3 mb-3 font-weight-normal">Registro del Sistema</h1> 
	  	
	  	<div class="input-group mb-3">
	  		<label for="inputEmail" class="sr-only">Email address</label>
		  		<div class="input-group-prepend">
		    		<span class="input-group-text" id="basic-addon1"><i class="fab fa-bitcoin"></i></span>
		  		</div>
		  		<input id="inputEmail" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required autofocus>
		</div>

		<div class="input-group mb-3">
	  		<label for="inputEmail" class="sr-only">Nombre</label>
		  		<div class="input-group-prepend">
		    		<span class="input-group-text" id="basic-addon1"><i class="fab fa-bitcoin"></i></span>
		  		</div>
		  		<input id="inputEmail" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1" required autofocus>
		</div>
		<div class="input-group mb-3">
	  		<label for="inputEmail" class="sr-only">Telefono</label>
		  		<div class="input-group-prepend">
		    		<span class="input-group-text" id="basic-addon1"><i class="fab fa-bitcoin"></i></span>
		  		</div>
		  		<input id="inputEmail" type="text" class="form-control" placeholder="Telefono" aria-label="Telefono" aria-describedby="basic-addon1" required autofocus>
		</div>

		<hr>
		<br>
		<h5>Autentificación de Password</h5>
		<br>
		<div class="input-group mb-3">
	  		<label for="inputEmail" class="sr-only">Password</label>
		  		<div class="input-group-prepend">
		    		<span class="input-group-text" id="basic-addon1"><i class="fab fa-bitcoin"></i></span>
		  		</div>
		  		<input id="inputEmail" type="text" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required autofocus>
		</div>
		<div class="input-group mb-3">
	  		<label for="inputEmail" class="sr-only">Reescribir Password</label>
		  		<div class="input-group-prepend">
		    		<span class="input-group-text" id="basic-addon1"><i class="fab fa-bitcoin"></i></span>
		  		</div>
		  		<input id="inputEmail" type="text" class="form-control" placeholder="Reescribir Password" aria-label="Reescribir Password" aria-describedby="basic-addon1" required autofocus>
		</div>
		
		<hr>

		  <!--<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>-->
		  
		  <!--<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>-->
	 
	  <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>
	  <br>
	  <a class="mt-2 mb-3" href="index.php">www.mgmbit.com</a><br>
	  <a class="mt-2 mb-3" href="mgm.php?m=login">Sign in</a>
	  <p class="mt-5 mb-3 text-muted"> Copyright &copy; 2020</p>
	</form>
</body>
</html>