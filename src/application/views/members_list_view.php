<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
	<head>
        <?php include_once('./application/views/head.php'); ?>
	</head>
	<body>
		<div class="container">
			<?php include_once('./application/views/menu.php'); ?>
			
			<?php if($sessionMember->getPrivilegio() == "Admin" || $sessionMember->getPrivilegio() =="Manager"):?>
				<div class="row">
					<div class="col-md-3" id="alerta">
						<?php
							if(isset($msg) && isset($msg['cadastrado'])){
								echo $msg['cadastrado'];
							}
						?>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-3"></div>
					<div class="col-md-3">
						<a id="addbutton" class="btn btn-primary btn-lg" href="<?php echo $baseUrl;?>index.php/members/addMember">Adicionar Membro</a>
					</div>
				</div>
			<?php endif;?>
			<table class="table table-striped centralizaTudo centralizaTudo">
				<tbody>
					<tr>
						<th>Foto</th>
						<th>Nome</th>
						<th>Lattes</th>
						<th>Área</th>
						<th>Privilegio</th>
						<?php if($sessionMember->getPrivilegio() == "Admin" || $sessionMember->getPrivilegio() =="Manager"):?>
							<th>Ações</th>	
						<?php endif;?>			
					</tr>
					
					<?php foreach($membersList as $row):?>
						<tr class="memberTableLine">
							<td><img class="membersTableImage" src="<?php echo $baseUrl;?>static/imgs/membros/<?php echo $row->getFoto();?>" /></td>
							<td class="centralizaHorizontal capitalize" ><?php echo $row->getNome();?></td>
							<?php if($row->getLattesLink()!= null):?>	
								<td class="centralizaHorizontal capitalize" ><a href="<?php echo $row->getLattesLink();?>"><img src="<?php echo $baseUrl;?>static/imgs/icon_lattes.png"/></a></td>
							<?php else: ?>
								<td class="centralizaHorizontal capitalize" >Não possui</td>
							<?php endif; ?>	
							<td class="centralizaHorizontal"><?php echo $row->getArea();?></td>							
							<td class="centralizaHorizontal"><?php echo $row->getPrivilegio();?></td>							
							<?php if($sessionMember->getPrivilegio() == "Admin" || $sessionMember->getPrivilegio() =="Manager"):?>	
								<td class="centralizaHorizontal">
									<a title="Editar" href="<?php echo $baseUrl;?>index.php/members/edit/<?php echo urlencode($row->getLogin()->getEmail());?>"><span class="glyphicon glyphicon-edit"></span></a>
									
									<button class="btn blob" diretion="<?php echo $baseUrl;?>index.php/members/delete/<?php echo urlencode($row->getLogin()->getEmail());?>" title="Excluir" data-toggle="popover" title="Confirmar Exclusão" data-html="true" ><span class="glyphicon glyphicon-remove"></span></button>

								</td>	
							<?php endif;?>							
						</tr>
					<?php endforeach;?> 
				</tbody>
			</table>
		</div>
	</body>	
</html>