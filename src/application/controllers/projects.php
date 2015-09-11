<?php
/**
 * @file  Canvas.php
 * @brief  Sistema de login do canvas
 * @date   Set 30, 2014
 * @author thais Alencar
 */
/**
 * @class Members
 * @brief Mostra, cadastra, edita, apaga e valida os usuarios.
 */
class Projects extends CI_Controller{
    ///Chama a bibilioteca URL do codeigniter.
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }
    /// Mostrar os membros cadastrados, mostrando o nome, lattes, área e privilegio.
    ///\param msg
    function index(){
        $this->load->library('session');
        ///Verifica se a sessão está aberta.
        if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
            $data['baseUrl'] = base_url();//get the base URL
            $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
            $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
            ///Caso esteja, carrega a login_model.    
        }else{//if the user are logged in
            $this->load->model('login_model');
            $this->load->model('projects_model');
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
            $data['projectList'] = $this->projects_model->getAll();
            switch($data['sessionMember']->getPrivilegio()){
                case "Admin":
                    $this->load->view('project_list_view',$data);//if the loged user are a
                    break;
                case "Manager":
                    $this->load->view('project_list_view',$data);//if the loged user are a
                    break;    
                case "Worker":
                    $this->load->view('project_list_view',$data);//if the loged user are a
                    break;
                default:
                    echo "You have a problem with your access levels";
                    break;
            }
        }
    }

    function getProjectsAsJSON(){
        $this->load->library('session');
        ///Verifica se a sessão está aberta.
        if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
            $data['baseUrl'] = base_url();//get the base URL
            $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
            $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
            ///Caso esteja, carrega a login_model.    
        }else{//if the user are logged in
            $this->load->model('login_model');
            $this->load->model('projects_model');
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
            $data["jsonData"] = $this->projects_model->getAll();
            switch($data['sessionMember']->getPrivilegio()){
                case "Admin":
                    $this->load->view('json_render.php',$data);// implementar ADM dashboard
                    break;
                case "Manager":
                    $this->load->view('json_render.php',$data);// implementar ADM dashboard
                    break;    
                case "Worker":
                    $this->load->view('json_render.php',$data);// implementar ADM dashboard
                    break;
                default:
                    echo "You have a problem with your access levels";
                    break;
            }
        }
    }
    
    function create(){

        $this->load->library('session');
        ///Verifica se a sessão está aberta.
        if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
            $data['baseUrl'] = base_url();//get the base URL
            $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
            $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
            ///Caso esteja, carrega a login_model.    
        }else{//if the user are logged in

            //date valide==========
            $data = explode("/", $this->input->post('finalDate'));   
            if(checkdate($data[1], $data[0], $data[2])){
               $dateOk = true;
            }else{
               $dateOk = false;
            }      
            // ====================== 
                $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
                $this->form_validation->set_rules('projectName','Nome','required');//setting a form_validation rule to the field 'name'
                $this->form_validation->set_rules('gp','Gerente','required');//setting a form_validation rule to the field 'name'
                $this->form_validation->set_rules('finalDate','Data Final','required');//setting a form_validation rule to the field 'name'

                if($this->form_validation->run() && $dateOk){
                    $projectName = $this->input->post('projectName');
                    $gp = $this->input->post('gp');
                    $initialDate = date("Y-m-d");                
                    $finalDate = implode("-", array_reverse(explode("/", $this->input->post('finalDate')))); 
                                              
                    $this->load->model('projects_model');
                    $data["jsonData"]["status"] = $this->projects_model->create($projectName, $gp, $initialDate, $finalDate);
                    $this->load->view('json_render.php',$data);// implementar ADM dashboard       
                }else{
                    $data["jsonData"]["status"] = false;
                    $data["jsonData"]["errors"] = array();
                    $fields = array('projectName', 'gp', 'finalDate');
                    
                    foreach($fields as $field){
                        $error = form_error($field, '<strong><li>', '</strong></li>');
                        if($error != ""){
                            $data["jsonData"]["errors"][] = $error;
                        }
                    }
                    if(! $dateOk){
                        $data["jsonData"]["errors"][] = "<strong><li>Data inválida</strong></li>";
                    }
                    $this->load->view('json_render.php',$data);// implementar ADM dashboard
                }  
        }
    }
    
    function delete(){
        $this->load->library('session');
        ///Verifica se a sessão está aberta.
        if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
            $data['baseUrl'] = base_url();//get the base URL
            $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
            $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
            ///Caso esteja, carrega a login_model.    
        }else{//if the user are logged in
            /// Checa se o email e senha informado estão conforme os padrões para os mesmo.
            $this->form_validation->set_rules('id','ID do Projeto','required');//setting a form_validation rule to the field 'name'
            if($this->form_validation->run()){
                $id = $this->input->post('id');
                $this->load->model('projects_model');
                $data["jsonData"]["status"] = $this->projects_model->delete($id);
                $this->load->view('json_render.php',$data);// implementar ADM dashboard
            }else{
                $data["jsonData"]["status"] = false;
                $this->load->view('json_render.php',$data);// implementar ADM dashboard
            }
        }
    }
    
    function update(){
        $this->load->library('session');
        ///Verifica se a sessão está aberta.
        if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
            $data['baseUrl'] = base_url();//get the base URL
            $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
            $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
            ///Caso esteja, carrega a login_model.    
        }else{//if the user are logged in
            /// Checa se o email e senha informado estão conforme os padrões para os mesmo.
            $this->form_validation->set_message('required', 'O campo %s não pode ser vazio.');
            $this->form_validation->set_rules('projectName','Nome','required');//setting a form_validation rule to the field 'name'
            $this->form_validation->set_rules('gp','Gerente','required');//setting a form_validation rule to the field 'name'
            $this->form_validation->set_rules('finalDate','Data Final','required');//setting a form_validation rule to the field 'name'
            if($this->form_validation->run()){
                $projectID = $this->input->post('id');
                $projectName = $this->input->post('projectName');
                $gp = $this->input->post('gp');
                $finalDate = implode("-", array_reverse(explode("/", $this->input->post('finalDate'))));
                
                $this->load->model('projects_model');
                $data["jsonData"]["status"] = $this->projects_model->update($projectID, $projectName, $gp, $finalDate);
                $this->load->view('json_render.php',$data);// implementar ADM dashboard
            }else{
                $data["jsonData"]["status"] = false;
                $data["jsonData"]["errors"] = array();
                $fields = array('projectName', 'gp', 'finalDate');
                
                foreach($fields as $field){
                    $error = form_error($field, '<strong><li>', '</strong></li>');
                    if($error != ""){
                        $data["jsonData"]["errors"][] = $error;
                    }
                }
                
                $this->load->view('json_render.php',$data);// implementar ADM dashboard
            }
        }
    }
    
    function loadProjectCanvas($id){
        $this->load->library('session');
        ///Verifica se a sessão está aberta.
        if(!$this->session->userdata('logged')){//if session var 'logged' does not exist, the user has not logged in.
            $data['baseUrl'] = base_url();//get the base URL
            $this->session->sess_destroy();//destroy the session created to verify the session var 'logged'.
            $this->load->view('login_view',$data);//load 'loginView' and send the '$data' array.
            ///Caso esteja, carrega a login_model.    
        }else{//if the user are logged in
            $this->load->model('login_model');
            $email = $this->session->userdata('email');
            $data['sessionMember'] = $this->login_model->getUserData($email);
            
            $this->load->model('projects_model');
            $data["canvasId"] = $id;
            $data["canvas"] = $this->projects_model->getCanvas($id);
            $data["projeto"] = $this->projects_model->getProjeto($id);
            $data['baseUrl'] = base_url();
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            switch($data['sessionMember']->getPrivilegio()){
                case "Admin":
                    $this->load->view('project_canvas_view.php',$data);// implementar ADM dashboard
                    break;
                case "Manager":
                    $this->load->view('project_canvas_view.php',$data);// implementar ADM dashboard
                    break;    
                case "Worker":
                    $this->load->view('project_canvas_view.php',$data);// implementar ADM dashboard
                    break;
                default:
                    echo "You have a problem with your access levels";
                    break;
            }
        }
    }
    function updateCanvas(){
        $id_canvas = $_POST['id_canvas'];
        $justificativas = $_POST['justificativas'];
        $produto = $_POST['produto'];
        $stake = $_POST['stake'];
        $premissas = $_POST['premissas'];
        $riscos = $_POST['riscos'];
        $objetivo = $_POST['objetivo'];
        $beneficios = $_POST['beneficios'];
        $requisitos = $_POST['requisitos'];
        $equipe = $_POST['equipe'];
        $entregas = $_POST['entregas'];
        $tempo = $_POST['tempo'];
        $restricoes = $_POST['restricoes'];
        $custos = $_POST['custos'];
        $id_projeto = $_POST['id_projeto'];

        $this->load->model('projects_model');
        if($this->projects_model->updateCanvas($id_canvas, $justificativas, $produto, $stake, $premissas, $riscos, $objetivo, $beneficios, $requisitos, $equipe, $entregas, $tempo, $restricoes, $custos, $id_projeto)){
            return true;
        }else{
            return false;
        }            
    }
}     
        
?>
