<?php
	class Canvas{
        private $id_canvas;
		private $justificativas;
        private $objsmart;
        private $beneficios;
        private $produto;
        private $requisitos;
        private $stakeholders;
        private $equipe;
        private $restricoes;
        private $premissas;
        private $grupodeentregas;
        private $riscos;
        private $linhadotempo;
        private $custos;
        private $id_projeto;
        
		function __construct($params){
            $this->id_canvas = $params['id_canvas'];
			$this->justificativas = $params['justificativas'];
			$this->objsmart = $params['objsmart'];
			$this->beneficios = $params['beneficios'];
			$this->produto = $params['produto'];
			$this->requisitos = $params['requisitos'];
			$this->stakeholders = $params['stakeholders'];
			$this->equipe = $params['equipe'];
			$this->restricoes = $params['restricoes'];
			$this->premissas = $params['premissas'];
			$this->grupodeentregas = $params['grupodeentregas'];
			$this->riscos = $params['riscos'];
			$this->linhadotempo = $params['linhadotempo'];
            $this->custos = $params['custos'];
			$this->id_projeto = $params['id_projeto'];
		}
		
        function getJustificativas(){return $this->justificativas;}
		
        function setJustificativas($justificativas){$this->justificativas=$justificativas;}
        
        function getObjsmart(){
            return $this->objsmart;
        }
		
        function setObjsmart($objsmart){
            $this->objsmart = $objsmart;
        }
        
        function getBeneficios(){
            return $this->beneficios;
        }
		
        function setBeneficios($beneficios){
            $this->Beneficios = $beneficios;
        }
        
        function getProduto(){
            return $this->produto;
        }
		
        function setProduto($produto){
            $this->produto = $produto;
        }
        
        function getRequisitos(){
            return $this->requisitos;
        }
		
        function setRequisitos($requisitos){
            $this->requisitos = $requisitos;
        }
        
        function getStakeholders(){
            return $this->stakeholders;
        }
		
        function setStakeholders($stakeholders){
            $this->stakeholders = $stakeholders;
        }
        
        function getEquipe(){
            return $this->equipe;
        }
		
        function setEquipe($equipe){
            $this->equipe = $equipe;
        }
        
        function getRestricoes(){
            return $this->restricoes;
        }
		
        function setRestricoes($restricoes){
            $this->restricoes = $restricoes;
        }
        
        function getPremissas(){
            return $this->premissas;
        }
		
        function setPremissas($premissas){
            $this->premissas = $premissas;
        }
        
        function getGrupoDeEntregas(){
            return $this->grupodeentregas;
        }
		
        function setGrupoDeEntregas($grupodeentregas){
            $this->grupodeentregas = $grupodeentregas;
        }
        
        function getRiscos(){
            return $this->riscos;
        }
		
        function setRiscos($riscos){
            $this->riscos = $riscos;
        }
        
        function getLinhaDoTempo(){
            return $this->linhadotempo;
        }
		
        function setLinhaDoTempo($linhadotempo){
            $this->linhadotempo = $linhadotempo;
        }
        
        function getCustos(){
            return $this->custos;
        }
		
        function setCustos($custos){
            $this->custos = $custos;
        }
         function getId_projeto(){
            return $this->id_projeto;
        }
        
        function setId_projeto($id_projeto){
            $this->id_projeto = $id_projeto;
        }
        function getId_canvas(){
            return $this->id_canvas;
        }
        
        function setId_canvas($id_canvas){
            $this->id_canvas = $id_canvas;
        }
        
        public function getAsJSON(){
            $var = get_object_vars($this);
            foreach($var as &$value){
                if(is_object($value) && method_exists($value,'getAsJSON')){
                    $value = $value->getAsJSON();
                }
            }
            return json_encode($var);
        }

        public function getAsArray(){
            $var = get_object_vars($this);
            foreach($var as &$value){
                if(is_object($value) && method_exists($value,'getAsArray')){
                    $value = $value->getAsArray();
                }
            }
            return $var;
        }
	}
?>
