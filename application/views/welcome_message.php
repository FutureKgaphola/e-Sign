<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH . '/helpers/url_helper.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>e-sign</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			margin: 0;
			height: 100vh;
			display: flex;
			justify-content: center;
			/* horizontal center */
			align-items: center;
			/* vertical center */
			background-image: url('../../public/assets/images/frac.jpg');
			background-size: cover;
			/* Cover the entire screen */
			background-position: center;
			/* Center the image */
			background-repeat: no-repeat;
			/* Prevent tiling */
		}



		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: bold;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 1px;
		}

		#container {
			margin: 50px;
			padding: 15px;
			min-width: 500px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
			background-color: #fff;
		}
	</style>
</head>

<body>

	<div class='d-flex flex-column p-2'>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button"
					role="tab" aria-controls="tab1" aria-selected="true">
					Register
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
					role="tab" aria-controls="tab2" aria-selected="false">
					Admin
				</button>
			</li>

		</ul>

		<!-- Tab panes -->
		<div class="tab-content mt-3">
			<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
				<div id="container">
					<img src='../../public/assets/images/SITAlogo.gif' />
					<h1>SITA e-sign</h1>
					<p>Mark your register here.</p>
					<?php if (!empty($this->session->userdata('sign_error'))): ?>
					<div class="small alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Error: </strong>
						<?php echo ($this->session->userdata('sign_error'));?>
						<?php  $this->session->unset_userdata('sign_error');?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php endif; ?>

					<?php if (!empty($this->session->userdata('sign_success'))): ?>
					<div class="small alert alert-success alert-dismissible fade show" role="alert">
						<strong>Hurray!, </strong>
						<?php echo ($this->session->userdata('sign_success'));?>
						<?php  $this->session->unset_userdata('sign_success');?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<script>
						setTimeout(function () {
							window.location.href = "<?php echo base_url(); ?>";
						}, 3000); // 3 seconds
					</script>
					<?php endif; ?>


					<form action="<?php echo base_url('index.php/user/update_attendence')?>" method="post">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-123" viewBox="0 0 16 16">
									<path
										d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75z" />
								</svg>
							</span>
							<input id='empnum' name="empnum" type="text" class="form-control" required
								placeholder="Employee Number" aria-label="empnum" aria-describedby="basic-addon1">
						</div>


						<div class='d-flex gap-1 align-items-center'>
							<button id='btnlogin' type="submit" class="btn btn-primary">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-check-circle" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
									<path
										d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
								</svg>
								Mark</button>
						</div>
					</form>
					
					<div style="display: none; margin-left: 10px;" id=''
						class="spinner-border spinner-border-sm text-primary" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<div class="text-muted pt-2 text-center">Copyright &copy; <a target="_blank"
							href="https://www.sita.co.za/">SITA</a>
						2025</div>
				</div>
			</div>
			<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
				<div id="container">
					<img src='../../public/assets/images/SITAlogo.gif' />
					<h1>SITA e-sign</h1>
					<p>Reserved for Administrator</p>

					<form action="<?php echo base_url('index.php/auth')?>" method="post">
						<label for="basic-url" class="form-label">Email</label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1">@</span>
							<input id='userEmail' name="username" type="text" class="form-control"
								placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
						</div>
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Password</label>
							<input id='userPass' name="password" type="password" class="form-control"
								id="exampleInputPassword1">
						</div>

						<div class='d-flex gap-1 align-items-center'>
							<button id='btnlogin' type="submit" class="btn btn-primary">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-person-circle" viewBox="0 0 16 16">
									<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
									<path fill-rule="evenodd"
										d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
								</svg>
								Sign in</button>
						</div>
					</form>
					<?php if (!empty($error)): ?>
					<p style="color:red;">
						<?php echo $error; ?>
					</p>
					<?php endif; ?>
					<div style="display: none; margin-left: 10px;" id=''
						class="spinner-border spinner-border-sm text-primary" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<div class="text-muted pt-2 text-center">Copyright &copy; <a target="_blank"
							href="https://www.sita.co.za/">SITA</a>
						2025</div>
				</div>
			</div>
			<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
				<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
					amet risus.</p>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
		integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
		integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
		crossorigin="anonymous"></script>

	<script src="<?php echo base_url().'/assets/js/login.js';?>"></script>
</body>

</html>