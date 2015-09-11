<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/css/login.css">
	</head>
	<body>
		<div class="container">
			<?php if(isset($errors)):?>
				<p><?php echo $errors;?></p>
			<?php endif;?>
			<div id="box"  class="form-box">
				<form action="<?php echo $baseUrl;?>index.php/login/tryLogin" method="post">
					<input id="form-login" class="form-control" type="text" placeholder="email" name="email"/>
					<input id="form-senha" class="form-control" type="password" placeholder="senha" name="senha"/>
					<label class="checkbox">
						<input type="checkbox" value="remember-me">Lembrar-me
					</label>
					<button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
				</form>
			</div>
		</div>
	</body>
</html>

