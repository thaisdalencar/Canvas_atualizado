<?php
/**
 * @file  members_model.php
 * @brief  Sistema de login do canvas
 * @date   Set 30, 2014
 * @author thais Alencar
 */
/**
 * @class Members_model
 * @brief Busca, cadastra, edita, apaga e valida os usuarios no banco.
 */
class Members_model extends CI_Model{
	///Busca no banco o cadastro completo de todos os membros.
	function getAll(){				
		$query = "SELECT *  
				    FROM logins
				    INNER JOIN cadastros
				    INNER JOIN fotos
				    INNER JOIN areas
				    INNER JOIN privilegios
				    ON login_fk = idLogins
				    AND foto_cadastro_fk = idCadastros
				    AND (area_fk = idAreas OR area_fk IS NULL)
				    AND privilegio_fk = idPrivilegios;";
		$result = $this->db->query($query);
		$membersList = array();
		if($result->num_rows()>0){//retorna o numero de linhas selecionadas
			foreach ($result->result() as $row){//retorna os dados como vetor
				$loginVars = array('email'=>$row->email,'senha'=>$row->senha);
				$this->load->library('/beans/user_login',$loginVars);
				$login = new $this->user_login($loginVars);
				$memberVars = array('nome'=>$row->nome,'lattesLink'=>$row->lattes,'login'=>$login,'foto'=>$row->caminho,'privilegio'=>$row->nomeDoPrivilegio, 'nivel'=> $row->idPrivilegios,'area'=>$row->area_nome);
				$this->load->library('/beans/member',$memberVars);
				///Cria o objeto Member
				$member = new $this->member($memberVars);
				$membersList[]=$member;
			}
		}
		///\return membersList
		return $membersList;
	}
	///Insere os cadastro de um novo membro no banco.
	///\param name_foto
	function insertMember($name_foto=null){
		///Inserio primeiro na tabela login.		
		$login = array(
			'email'=> $_POST['email'],
			'senha'=> md5($_POST['password'])
		);
		
		if($this->db->insert('logins', $login)){//tenta insserir na tabela logins
			$id_login = $this->db->insert_id();
			/// Depois na tabela cadastro.
			$cadastro = array();
			
			$cadastro['nome'] = $_POST['nome'];

			if(isset($_POST['lattes']) && $_POST['lattes'] != ""){
				$cadastro['lattes'] = $_POST['lattes'];
			}
			
			$cadastro['privilegio_fk'] = $_POST['privilegio'];
			
			$cadastro['area_fk'] = $_POST['area'];
						
			$cadastro['login_fk'] = $id_login;
			if($this->db->insert('cadastros', $cadastro)){//tenta inserir na tabela cadastros
				$id_cadastro = $this->db->insert_id();
				
				$foto = array(
					'caminho'=> $name_foto,
					'foto_cadastro_fk'=> $id_cadastro
				);
				///Depois na tabela fotos.
				if($this->db->insert('fotos', $foto)){//tenta inserir na tabela fotos
					$id_foto = $this->db->insert_id();	
					///caso insira com sucesso em todas:
					///\return True				
					return true;
				}else{
					return false;
				}
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}
	///Busca as Areas disponiveis para casdrasto.
	function getAreas(){
		$result = $this->db->get('areas');
		$areas= array();	
		if($result->num_rows()>0){
			foreach ($result->result() as $row){
				$areas[] = array($row->idAreas, $row->area_nome);
			}	
		}
		///\return areas
		return $areas;		
	}
	///Busca os privilegios disponiveis para cadrastro.
	function getPrivilegios(){
		$result = $this->db->get('privilegios');
		$privilegios= array();	
		if($result->num_rows()>0){
			foreach ($result->result() as $row){
				$privilegios[] = array($row->idPrivilegios, $row->nomeDoPrivilegio);
			}	
		}
		///\return Privilegios
		return $privilegios;			
	}
	///Faz o update dos cadastros no banco.
	function updateMember($editMember){
		$email =$editMember->getLogin()->getEmail();
		$query = "SELECT idCadastros from cadastros inner join logins on login_fk = idLogins and email= ?;";		
		$result = $this->db->query($query, $email);
		$id = $result->result()[0]->idCadastros;
	
		$caminho = $editMember->getFoto();
		$query = "UPDATE fotos set caminho = '$caminho' where foto_cadastro_fk= $id;";
		$result = $this->db->query($query);	

		$nome = $_POST['nome'];
		$lattes = $_POST['lattes'];
		$area = $_POST['area'];
		$privilegio = $_POST['privilegio'];

		$query =  "UPDATE cadastros set 
		 	nome = '$nome', 
			lattes = '$lattes', 
			privilegio_fk = $privilegio, 
		 	area_fk = $area
			where idCadastros = $id;";
		$result = $this->db->query($query);	
		if(isset($_POST['password']) && $_POST['password'] != ""){
			$senha = md5($_POST['password']);
			$query= "UPDATE logins set senha= '$senha' where email = '$email';";
			$result = $this->db->query($query);				
		}
		
	}
	///Deleta os membros do banco.
	///\param editMember
	function deleteMember($editMember){
		$email =$editMember->getLogin()->getEmail();
		$query = "SELECT idCadastros,idLogins from cadastros inner join logins on login_fk = idLogins and email= ?;";		
		$result = $this->db->query($query, $email);
		$id = $result->result()[0]->idCadastros;
		$id_login = $result->result()[0]->idLogins;
		$query= "DELETE from fotos where foto_cadastro_fk= $id";
		$result = $this->db->query($query);
		$query= "DELETE from cadastros where idCadastros= $id";
		$result = $this->db->query($query);
		$query= "DELETE from logins where idLogins= $id_login";

		$result = $this->db->query($query);
	}

}
?>

