<?php
/**
 * @file  login_model.php
 * @brief  Sistema de login do canvas
 * @date   Set 30, 2014
 * @author thais Alencar
 */
/**
 * @class Login_model
 * @brief realização do login e logout.
 */
class Login_model extends CI_Model{
	///Valida o usuario
	function validateUser($email,$password){
		///Procura o email.
		$this->db->where('email',$email);
		///Procura a senha.
		$this->db->where('senha',$password);
		/// Pega dados da tabela Cadastros onde há esse login e senha.
		$query = $this->db->get('logins');
		/// Confirma se há 1 registro para esses dados no banco.
		if($query -> num_rows == 1){
			///Caso verdadeiro:
			///\return true
			return true;
		}
		else{
			return false;
		}
	}
	///Busca os dados do usuario.
	///\param email
	function getUserData($email){
		$query = "SELECT *  
			FROM logins
			INNER JOIN cadastros
			INNER JOIN fotos
			INNER JOIN areas
			INNER JOIN privilegios
			ON login_fk = idLogins
			AND email = ?
			AND foto_cadastro_fk = idCadastros
			AND (area_fk = idAreas OR area_fk IS NULL)
			AND privilegio_fk = idPrivilegios;";
		$result = $this->db->query($query, $email);
		if($result->num_rows()>0){//retorna o numero de linhas selecionadas
			foreach ($result->result() as $row){//retorna os dados como vetor
				$loginVars = array('email'=>$row->email,'senha'=>$row->senha);
				$this->load->library('/beans/user_login',$loginVars);
				$login = new $this->user_login($loginVars);
				//var_dump($login);

				$memberVars = array('nome'=>$row->nome,'lattesLink'=>$row->lattes,'login'=>$login,'foto'=>$row->caminho,'privilegio'=>$row->nomeDoPrivilegio,'nivel'=> $row->idPrivilegios , 'area'=>$row->area_nome);
				$this->load->library('/beans/member',$memberVars);
				///Os dados obtidos no banco criam o objeto Member
				$member = new $this->member($memberVars);
				return $member;
			}
		}
	}	
}
?>

