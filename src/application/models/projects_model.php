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
class Projects_model extends CI_Model{
	function getAll(){				
		$query = "SELECT * , DATEDIFF( dtf_projeto, NOW( ) ) AS diferenca from projeto";
		$result = $this->db->query($query);
		$projetoList = array();
		if($result->num_rows()>0){
			foreach ($result->result() as $row){
				$projectVars = array('id'=>$row->id_projeto,'nome'=>$row->no_projeto,'gp'=>$row->gp_projeto,'inicio'=> $row->dti_projeto,'fim'=>$row->dtf_projeto);
				$this->load->library('/beans/projeto',$projectVars);
                
				$project = new $this->projeto($projectVars);
				$projetoList[]=$project;
			}
		}
		return $projetoList;
	}
    
    function create($projectName, $gp, $initialDate, $finalDate){
        $query = "INSERT INTO `projeto`(`no_projeto`, `gp_projeto` , `dti_projeto` , `dtf_projeto`) VALUES ('$projectName', '$gp' , '$initialDate' , '$finalDate')";
		$result = $this->db->query($query);
        return $result;
    }
    
    function delete($id){
        $query = "DELETE FROM canvas WHERE projeto_id_projeto = $id";
        $result = $this->db->query($query);
        
        $query = "DELETE FROM projeto WHERE id_projeto = $id";
        $result = $this->db->query($query);
        
		return $result;
    }
    
    function update($id, $nome, $gp, $dataFinal){
        $query = "
            UPDATE projeto SET
            no_projeto = ?,
            gp_projeto = ?,
            dtf_projeto = ?
            WHERE id_projeto = ?;
            ";
        $result = $this->db->query($query, array($nome, $gp, $dataFinal, $id));
        return $result;
        //return $this->db->last_query();
    }
    
    function getCanvas($id){
        $query = "SELECT * FROM labmanager.canvas WHERE projeto_id_projeto = ?;";
        $result = $this->db->query($query, array($id));

		if(!$result->num_rows() > 0){
            $query = "INSERT INTO canvas (`de_justificativas`, `de_objsmart`, `de_beneficios`, `de_produto`, `de_requisitos`, `de_stakeholders`, `de_equipe`, `de_restricoes`, `de_premissas`, `de_grupodeentregas`, `de_riscos`, `de_linhadotempo`, `de_custos`, `projeto_id_projeto`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', $id);";
            $result = $this->db->query($query);
            
            $query = "SELECT * FROM labmanager.canvas WHERE projeto_id_projeto = ?;";
            $result = $this->db->query($query, array($id));
            
        }
        
        $row = $result->result()[0];
        $canvasVars = array(
            'id_canvas'=>$row->id_canvas ,
            'justificativas'=>$row->de_justificativas ,
            'objsmart'=>$row->de_objsmart ,
            'beneficios'=>$row->de_beneficios ,
            'produto'=>$row->de_produto ,
            'requisitos'=>$row->de_requisitos ,
            'stakeholders'=>$row->de_stakeholders ,
            'equipe'=>$row->de_equipe ,
            'restricoes'=>$row->de_restricoes ,
            'premissas'=>$row->de_premissas ,
            'grupodeentregas'=>$row->de_grupodeentregas ,
            'riscos'=>$row->de_riscos ,
            'linhadotempo'=>$row->de_linhadotempo ,
            'custos'=>$row->de_custos,
            'id_projeto'=>$row->projeto_id_projeto
        );      

        $this->load->library('/beans/canvas',$canvasVars);
        $canvas = new $this->canvas($canvasVars);
        return $canvas;
    }

    function getProjeto($id){
        //pegar dados cadastrais do projeto
        $query = "SELECT * FROM labmanager.projeto WHERE id_projeto = ?;";
        $result = $this->db->query($query, array($id));
        $row = $result->result()[0];
        $projeto = array(
            'id'=>$row->id_projeto ,
            'nome'=>$row->no_projeto ,
            'gp'=>$row->gp_projeto ,
            'inicio'=>$row->dti_projeto ,
            'fim'=>$row->dtf_projeto ,
        );
        $this->load->library('/beans/projeto',$projeto);
        $projeto = new $this->projeto($projeto);
        return $projeto;
    }

    function updateCanvas($id_canvas, $justificativas, $produto, $stake, $premissas, $riscos, $objetivo, $beneficios, $requisitos, $equipe, $entregas, $tempo, $restricoes, $custos, $id_projeto){
        var_dump("ola");
        var_dump($id_canvas);
        var_dump($produto);
        var_dump($justificativas);
        var_dump($stake);
        var_dump($premissas);
        var_dump($riscos);
        var_dump($objetivo);
        var_dump($beneficios);
        var_dump($requisitos);
        var_dump($equipe);
        var_dump($entregas);
        var_dump($tempo);
        var_dump($restricoes);
        var_dump($custos);


        $query = "UPDATE canvas SET
            de_justificativas = ?,
            de_objsmart = ?,
            de_beneficios = ?,
            de_produto = ?,
            de_requisitos = ?,
            de_stakeholders = ?,
            de_equipe = ?,
            de_restricoes = ?,
            de_premissas = ?,
            de_grupodeentregas = ?,
            de_riscos = ?,
            de_linhadotempo = ?,
            de_custos = ?,
            projeto_id_projeto = ?
            WHERE id_canvas = ?
            ";        
        if($this->db->query($query, array($justificativas, $objetivo, $beneficios, $produto, $requisitos, $stake, $equipe, $restricoes, $premissas, $entregas,  $riscos, $tempo, $custos, $id_projeto, $id_canvas))){
            return true;
        }else{
            return false;
        }
    }
}

  
?>
