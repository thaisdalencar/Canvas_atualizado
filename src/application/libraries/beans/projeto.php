<?php
	class Projeto{
		private $id;
		private $nome;
		private $gp;
		private $inicio;
		private $fim;
		function __construct($params){
			$this->id = $params['id'];
			$this->nome = $params['nome'];
			$this->gp = $params['gp'];
			$this->inicio = $params['inicio'];
			$this->fim = $params['fim'];
            /*
            $this->inicio = date_format(new DateTime($params['inicio']), 'd/m/Y');
			$this->fim = date_format(new DateTime($params['fim']), 'd/m/Y');
            */
		}
		
        function getId(){
			return $this->id;
		}
		
        function setId($id){
			$this->id=$id;
		}
        
		function getNome(){
			return $this->nome;
		}
		
        function setNome($nome){
			$this->nome=$nome;
		}
		
		function getGp(){
			return $this->gp;
		}
        
		function setGp($gp){
			$this->gp=$gp;
		}
        
		function getInicio(){
			return $this->inicio;
		}
        
		function setInicio($inicio){
			$this->inicio = $inicio;
		}
        
		function getFim(){
			return $this->fim;
		}
        
		function setFim($Fim){
			$this->fim=$Fim;
		}
		
        function getDeadLineStatus(){
            $start = new DateTime('NOW');
            $end = new DateTime($this->getFim());
			$days = $end->diff($start)->days;
            $init = strtotime(date("Y-m-d"));
            $fim = strtotime($this->getFim());
            if( $init > $fim){
                return "prazo esgotado";
            }
            else{
                if ($days>1){
                    return $days." dias";
                }
                elseif($days==1){
                    return "amanhã";
                } 
                else{
                    return "hoje";
                }
            }
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
            /*
            $this->setInicio(date_format(new DateTime($this->getInicio()), 'd/m/Y'));
            $this->setFim(date_format(new DateTime($this->getFim()), 'd/m/Y'));
            */
            $var = get_object_vars($this);
            foreach($var as &$value){
                if(is_object($value) && method_exists($value,'getAsArray')){
                    $value = $value->getAsArray();
                }
            }
            $var['deadLineStatus'] = $this->getDeadLineStatus();
            $var['inicio'] = date_format(new DateTime($var['inicio']), 'd/m/Y');
            $var['fim'] = date_format(new DateTime($var['fim']), 'd/m/Y');
            return $var;
        }
	}
?>
