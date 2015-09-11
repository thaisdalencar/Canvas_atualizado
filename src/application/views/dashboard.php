<!DOCTYPE html>
<html>
	<head>
		<?php include_once('./application/views/head.php'); ?>
	</head>
	<body>
		<div class="container">
		<?php include_once('./application/views/menu.php'); ?>
			
			<div class="row">
				<div class="col-md-6">
					<a class="btn btn-primary btn-lg btn-block" href="<?php echo $baseUrl;?>index.php/members/getAll">Lista de Membros</a>
			 	</div>
				<div class="col-md-6">
					<a class="btn btn-primary btn-lg btn-block" href="<?php echo $baseUrl;?>index.php/projects">Lista de Projetos</a>
			 	</div>
			</div>
			
		</div>	
	</body>
</html>
