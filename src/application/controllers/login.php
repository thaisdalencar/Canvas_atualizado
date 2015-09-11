<?php
/*! \mainpage Projeto Canvas
 * \section intro_sec Introdução
 *
 * Documentação dos códigos usados para desenvolver o sistema de login e cadastro do Canvas.
 *
 */
/**
 * @file   login.php
 * @brief  Sistema de login do canvas
 * @date   Set 30, 2014
 * @author thais Alencar
 */
/**
 * @class Login
 * @brief Soliciata a realização do login e logout.
 */
class Login extends CI_Controller{
		/// Chama a biblioteca URL do codeigniter.
		function __construct(){
			parent::__construct();
			$this->load->helper('url');
		}
		///Analisa se existe sessão aberta.
        function index(){
			///Chama a biblioteca Session do Codeigniter.
			$this->load->library('session');
			///Caso não exista sessão aberta é redirecionado para a página de login.
			///@param logged
            
            $data['baseUrl'] = base_url();//get the base URL
            
            if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
                $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
                $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
			///caso a sessão esteja iniciada redireciona para a página principal.
			}
            else{//if the user are logged in
				///Carrega a login_model.
				$this->load->model('login_model');
				///Recebe o email da login_model.
				$email = $this->session->userdata('email');
				$data['sessionMember'] = $this->login_model->getUserData($email);
				///Analisa o privilegio do usuario.
				switch($data['sessionMember']->getPrivilegio()){
					case "Admin":
						$this->load->view('dashboard',$data);//if the loged user are a Admin.
						break;
					case "Manager":
						$this->load->view('dashboard',$data);//if the loged user are a Admin.
						break;
					case "Worker":
						$this->load->view('dashboard',$data);//if the loged user are a Admin.
						break;
					default:
						echo "Erro com o privilegio.";
						break;
				}
            }
		}
		///Realiza o login.
		function tryLogin(){
			/// Checa se o email e senha informado estão conforme os padrões para os mesmo.
			$this->form_validation->set_rules('email','Email','required');//setting a form_validation rule to the field 'name'
			$this->form_validation->set_rules('senha','Password','required');//setting a form_validation rule to the field 'name'
            
            $data['baseUrl'] = base_url();
			
            if($this->form_validation->run()){
				$email = $this->input->post('email');
				$password = md5($this->input->post('senha'));
				/// Caso estejam redirecionam para a login_model, passaso o email e senha informados.
				$this->load->model('login_model');
				$userExistence = $this->login_model->validateUser($email,$password);
				/// Se o banco retornar True, para a vefiricação do login no banco, o usuario é redirecionado para a página inicial.
				if($userExistence){
					$this->load->library('session');
					$this->session->set_userdata('logged',true);
					$data['sessionMember'] = $this->login_model->getUserData($email);					
					$this->session->set_userdata('email',$data['sessionMember']->getLogin()->getEmail());
					switch($data['sessionMember']->getPrivilegio()){
						case "Admin"://if the loged user are a Admin.
							$this->load->view('dashboard',$data);
							break;
						case "Manager"://if the loged user are a Admin.
							$this->load->view('dashboard',$data);
							break;
						case "Worker"://if the loged user are a Admin.
							$this->load->view('dashboard',$data);
							break;
						default:
							echo "You have a problem with your access levels";
					}
				///Caso retorne false, o usuario é redirecionado para a página de login.	
				}else{
					$data['errors'] = "Wrong, username or login.";
					$this->load->view('login_view',$data);
				}
			}else{
				$data['errors'] = "Blank username or login.";
				$this->load->view('login_view',$data);
			}
		}
		///Realiza o logout da sessão.
		function logOut(){
			///Chama a biblioteca Session.
			$this->load->library('session');
			///Destroy a sessão.
			$this->session->sess_destroy();
			$data['baseUrl'] = base_url();
			///Redireciona para a página de login.
			$this->load->view('login_view',$data);
		}
	}
?>
