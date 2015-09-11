<?php
	if(!isset($editMember)) die("Membro não selecionado.");
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once('./application/views/head.php'); ?>
	</head>
	<body>

		<div class="container">
			<?php include_once('./application/views/menu.php'); ?>
		
			<div class="row">
				  <div class="col-md-4 col-md-offset-4"> 
					<?php if(isset($errors)):?>
						<p><?php echo $errors;?></p>
					<?php endif;?>
						<div class="form-box">				
						<form enctype="multipart/form-data"  action="<?php echo $baseUrl;?>index.php/members/validateUpdate/<?php echo urlencode($editMember->getLogin()->getEmail());?>"  method="post" >
							<table>	
								<tr>
									<td>Nome </td>
									<td><input id="form-Nome" value="<?php echo $editMember->getNome(); ?>" class="form-control" type="text" placeholder="Nome" name="nome"/></td>
								</tr>
								<tr>
									<td>Login </td>						
									<td><input id="form-login" value="<?php echo $editMember->getLogin()->getEmail(); ?>" disabled="true" class="form-control" type="text" placeholder="Email" name="email"/></td>
								</tr>
								<tr>
									<td>Senha Nova</td>
									<td><input id="form-senha"  class="form-control" type="password" placeholder="Preecher apenas se desejar alterar!" name="password"/></td>
								</tr>
								<tr>
									<td>Confirmar senha</td>
									<td><input id="form-senha2" class="form-control" type="password" placeholder="Confirmar nova senha" name="password2"/></td>
								</tr>
								<tr>
									<td>Área</td>
									<td>
										<select name="area" class="form-control"> 
											<?php foreach ($areas as $row):?>											
											<option value="<?php echo $row[0];?>" <?php if($editMember->getArea() == $row[1]) echo 'selected' ?>  ><?php echo $row[1]; ?></option>				
											<?php  endforeach; ?>
										</select>								
									</td>
								</tr>
								<tr>
									<td>Privilegio</td>
									<td>
										<select name="privilegio" class="form-control"> 
											<?php foreach ($privilegios as $row):?>	
												<?php if( $row[0]>= $sessionMember->getNivel()): ?>									
													<option value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>	
												<?php endif; ?>													
											<?php  endforeach; ?>				
										</select>
									</td>
								</tr>
								<tr>
									<td>Lattes</td>
									<td><input id="form-lattes" value="<?php echo $editMember->getLattesLink(); ?>" class="form-control" type="text" placeholder="Lattes" name="lattes"/></td>
								</tr>
								<tr>
									<td>Foto</td>
									<td><input id="form-foto" class="form-control" type="file" placeholder="Foto" name="userfile" /></td>
								</tr>
								<tr>
									<td colspan="2"><button type="submit" class="btn btn-lg btn-primary btn-block">Atualizar</button></td>
								</tr>						
							</table>
						</form>
					</div>	
				</div>
			</div>		
		</div>
	</body>
</html>


