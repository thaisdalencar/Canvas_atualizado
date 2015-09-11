<?php
/**
 * @file  members.php
 * @brief  Sistema de login do canvas
 * @date   Set 30, 2014
 * @author thais Alencar
 */
/**
 * @class Members
 * @brief Mostra, cadastra, edita, apaga e valida os usuarios.
 */
class Members extends CI_Controller{
	///Chama a bibilioteca URL do codeigniter.
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	/// Mostrar os membros cadastrados, mostrando o nome, lattes, área e privilegio.
	///\param msg
	function getAll($msg=NULL){
		$this->load->library('session');
		///Verifica se a sessão está aberta.
		if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
			$data['baseUrl'] = base_url();//get the base URL
			$this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
			$this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
		///Caso esteja, carrega a login_model.	
		}else{//if the user are logged in
			$this->load->model('login_model');
			$this->load->model('members_model');
			$data['baseUrl'] = base_url();//get the base URL.
			$email = $this->session->userdata('email');
			$data['sessionMember'] = $this->login_model->getUserData($email);
			$data['baseUrl'] = base_url();
			if(isset($msg)){
				$data['msg']= $msg;	
			}
			///Analisa o privilegio do usuario.
			///Redireciona para a members_list_view.
			///Mostra os membros.
			$data['membersList'] = $this->members_model->getAll();
			switch($data['sessionMember']->getPrivilegio()){
				case "Admin":
					$this->load->view('members_list_view',$data);//if the loged user are a Admin.
					break;
				case "Manager":
					$this->load->view('members_list_view',$data);//if the loged user are a Admin.
					break;	
				case "Worker":
					$this->load->view('members_list_view',$data);//if the loged user are a Admin.
					break;
				default:
					echo "You have a problem with your access levels";
					break;
			}
		}
	}
	///Redireciona para a view de cadastro de novos membros.
	function addMember(){
		$this->load->library('session');
		///Verifica se a sessão está aberta.
		if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
			$data['baseUrl'] = base_url();//get the base URL
			$this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
			$this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
		///Caso esteja, carrega a login_model.	
		}else{//if the user are logged in
			$this->load->model('login_model');
			$this->load->model('members_model');
			$data['baseUrl'] = base_url();//get the base URL.
			$email = $this->session->userdata('email');
			$data['sessionMember'] = $this->login_model->getUserData($email);
			$data['baseUrl'] = base_url();
			$data['areas'] = $this->members_model->getAreas();
			$data['privilegios'] = $this->members_model->getPrivilegios();
			///Verifica o privilegio do usuário.
			switch($data['sessionMember']->getPrivilegio()){
				///Caso Admin, redireciona para a view registration_form_view, para realizar o novo cadastro.
				case "Admin":
					$this->load->view('registration_form_view',$data);
					break;
				///Caso manager, redireciona para a view registration_form_view, para realizar o novo cadastro.	
				case "Manager": 
					$this->load->view('registration_form_view',$data);//if the loged user are a Admin.
					break;	
				///Caso Worker, não permite adicionar novas membros.	
				case "Worker":
					$this->load->view('members_list_view',$data);//if the loged user are a Admin.
					break;	
				default: $this->load->view('dashboard',$data);
			}
		}
	}
	///Analisa se os dados informados no cadastro de novos membros são validos.		
	function validateMember(){
		$this->load->library('session');
		//======= PARA IMAGEM ========
		///Analisa se a imagem enviada está nos formatos gif|jpg|png e é menor que 4mb.
		///realiza a criptografia do nome da imagem.
		$config['upload_path'] = './static/imgs/membros/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4000';
		$config['overwrite']  = FALSE;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config);
		
		if ( $this->upload->do_upload() ){
			$upload_data = $this->upload->data();//array de iformações
			$name_foto = $upload_data['file_name'];// do array so pego no nome 							
		}			
		//======= PARA DADOS ========	
		///Analisa de os dados estão conforme o padrão.
		/// Analisa se os campos obrigatorios foram preenchidos. 
		$this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password2','Passwords','required|matches[password]');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[logins.email]');
		$this->form_validation->set_rules('privilegio','Privilegio','required');
		$this->form_validation->set_rules('area','area','required');

		$this->form_validation->set_message('required', 'O campo %s é requerido.');
		$this->form_validation->set_message('min_length', 'O tamanho mínino do campo %s é 4.');
		$this->form_validation->set_message('max_length', 'O tamanho máximo do campo %s é 15.');
		$this->form_validation->set_message('matches', 'Os %s não conferem.');
		$this->form_validation->set_message('valid_email', 'Insira um %s válido.');
		$this->form_validation->set_message('is_unique', 'O login já está cadastrado. Escolha outro.');
		
		//========= PARA MODEL========		
		///Caso todos os dados informados estejam ok, carrega a members_model.
		if($this->form_validation->run()){
			$this->load->model('members_model');	
			///Caso não tenham o upload de uma imagem, é gravado no banco uma imagem padrão. 
			if(!isset($name_foto)){//caso não tenham enviado uma foto
				$name_foto = "preferences_desktop_user.png";
			}
			///Caso os dados tenham sido gravados corretamente no banco, é mostrado uma mensagem de sucesso.
			if($this->members_model->insertMember($name_foto)){
				$this->load->model('login_model');
				$data['baseUrl'] = base_url();//get the base URL.
				$email = $this->session->userdata('email');
				$data['sessionMember'] = $this->login_model->getUserData($email);
				$data['baseUrl'] = base_url();
				$msg['cadastrado']='Cadastro feito com sucesso.';
				$this->getAll($msg);
			}else{	
				echo 'Por algum problema da Model não possível inserir o membro.';
			}
		}else{
			$this->load->model('login_model');
			$this->load->model('members_model');
			$data['baseUrl'] = base_url();//get the base URL.
			$email = $this->session->userdata('email');
			$data['sessionMember'] = $this->login_model->getUserData($email);
			$data['errors'] = validation_errors();
			$data['baseUrl'] = base_url();
			$data['areas'] = $this->members_model->getAreas();
			$data['privilegios'] = $this->members_model->getPrivilegios();
			$this->load->view('registration_form_view',$data);
		}
	}
	///Redireciona para a view de edição.
	///\param login
	function edit($login){
		///Verifica se a sessão está aberta.
		$login = urldecode($login);
		$this->load->library('session');
		if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
			$data['baseUrl'] = base_url();//get the base URL
			$this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
			$this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
		///Caso esteja, carrega a login_model.	
		}else{//if the user are logged in
			$this->load->model('login_model');
			$this->load->model('members_model');
			$data['baseUrl'] = base_url();//get the base URL.
			$email = $this->session->userdata('email');
			$data['sessionMember'] = $this->login_model->getUserData($email);
			$data['editMember'] = $this->login_model->getUserData($login);
			$data['baseUrl'] = base_url();
			$data['areas'] = $this->members_model->getAreas();
			$data['privilegios'] = $this->members_model->getPrivilegios();
			///Checa o privilegio do usuário.
			switch($data['sessionMember']->getPrivilegio()){
				///Caso Admin, redireciona para a view edit_form_view.
				case "Admin":
					$this->load->view('edit_form_view',$data);
					break;
				///Caso Manager, checa se o cadastro a ser editado é do mesmo nível ou a baixo do usuario, se sim, redireciona para a edit_form_view.
				case "Manager":
					if($data['editMember']->getNivel() >= $data['sessionMember']->getNivel()){
						$this->load->view('edit_form_view',$data);					
					}else{
						$msg['cadastrado']='Seu privilegio não lhe permite editar esse usuário.';
						$this->getAll($msg);
					}
					break;	
				///Caso Worker, não permite o redirecionamento.	
				case "Worker":
					$this->load->view('members_list_view',$data);//if the loged user are a Admin.
					break;	
				default: $this->load->view('dashboard',$data);
			}
		}
	}
	///Analisa se o cadastro editado contém dados validos.
	///\param login
	function validateUpdate($login){
		$login= urldecode($login);
		$this->load->model('login_model');
		$editMember = $this->login_model->getUserData($login);

		$config['upload_path'] = './static/imgs/membros/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4000';
		$config['overwrite']  = FALSE;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config);
		///Caso se tenha ocorrido a edição da imagem, se grava a imagem anteriormente já utilizada.
		if ( $this->upload->do_upload() ){
			$upload_data = $this->upload->data();//array de iformações
			$editMember->setFoto($upload_data['file_name']);// do array so pego no nome
		}
		$email = $editMember->getLogin()->getEmail();
		$password = $editMember->getLogin()->getSenha();
		
		///Caso não tenha ocorrido a edição da senha, se greve a senha anteriormente já utilizada.
		if($_POST['password']!= ""){
			$this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[15]');
			$this->form_validation->set_rules('password2','Passwords','required|matches[password]');
		}
		$this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('privilegio','Privilegio','required');
		$this->form_validation->set_rules('area','area','required');
		///Casos os dados estejam ok, a members_model é carregada.
		if($this->form_validation->run()){
			$this->load->model('members_model');
			$this->members_model->updateMember($editMember);
			///Caso os dados tenham sidos editados corretamente, é mostrada uma mensagem de sucesso.
			$msg['cadastrado']='Cadastro editado com sucesso.';
			$this->getAll($msg);
		}else{
			echo "nao veio o que queriamos";
		}
	}
	///Responsavel por deletar cadastros.
	///\param login
	function delete($login){
		$login = urldecode($login);
		$this->load->model('login_model');
		$editMember = $this->login_model->getUserData($login);
		$this->load->library('session');
		///Verifica se a sessão está aberta.
		if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
			$data['baseUrl'] = base_url();//get the base URL
			$this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
			$this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
		///Caso esteja, carrega a login_model.	
		}
        else{//if the user are logged in
			$this->load->model('login_model');
			$this->load->model('members_model');
			$data['baseUrl'] = base_url();//get the base URL.
			$email = $this->session->userdata('email');
			$data['sessionMember'] = $this->login_model->getUserData($email);
			$data['editMember'] = $this->login_model->getUserData($login);
			$data['baseUrl'] = base_url();
			$data['areas'] = $this->members_model->getAreas();
			$data['privilegios'] = $this->members_model->getPrivilegios();
			///Checa o privilegio do usuário.
			///Verificasse usuário possue privilegio igual ou superior ou que deseja deletar.
			///Caso não possua, é mostrado uma mensagem de alerta.
			///caso possua, a members_model é carregada, se o cadastro for deletado corretamente é mostrado uma mensagem de sucesso.
			switch($data['sessionMember']->getPrivilegio()){
				case "Admin":
					if(($data['sessionMember']->getLogin()->getEmail()) != ($data['editMember']->getLogin()->getEmail())){
						$this->members_model->deleteMember($editMember);
						$msg['cadastrado']='Cadastro excluido com sucesso.';
						$this->getAll($msg);
					}else{
						$msg['cadastrado']='Não é permitido auto-exclusão.';
						$this->getAll($msg);
					}	
					break;
				case "Manager":
					if(($data['sessionMember']->getLogin()->getEmail()) != ($data['editMember']->getLogin()->getEmail())){
						if($data['editMember']->getNivel() >= $data['sessionMember']->getNivel()){
							$this->members_model->deleteMember($editMember);
							$msg['cadastrado']='Cadastro excluido com sucesso.';
							$this->getAll($msg);
						}else{
							$msg['cadastrado']='Seu privilegio não lhe permite excluir esse usuário.';
							$this->getAll($msg);
						}
					}else{
					/*	echo(
						"<script language='JavaScript' TYPE='text/javascript'>
						var r = confirm('Confirmar exclusão?');
						if (r == true) {
						    x = 'You pressed OK!';
						} else {
						    x = 'You pressed Cancel!';
						}
						</script>");*/
						$msg['cadastrado']='Não é permitido auto-exclusão.';
						$this->getAll($msg);
					}	
					break;	
				case "Worker":
					echo "Ação não permitida.";					
					break;	
				default: $this->load->view('dashboard',$data);
			}
		}
	}	
}	
?>
