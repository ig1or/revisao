<?php
    require_once('forma.class.php');
    
    class Retangulo extends Forma {
    
        private $largura;
        private $altura;
    
        public function __construct($pid, $plargura, $paltura, $pcor, $pun,$pquadro) {
            parent::__construct($pid,'s',$pcor,$pun,$pquadro);
            $this->setLargura($plargura);
            $this->setAltura($paltura);
        }
    
        public function getLargura() {
            return $this->largura;
        }
    
        public function setLargura($largura) {
            if ($largura > 0) {
                $this->largura = $largura;
            } else {
                throw new Exception("Largura do retângulo inválida. Informe um valor maior que 0");
            }
        }
    
        public function getAltura() {
            return $this->altura;
        }
    
        public function setAltura($altura) {
            if ($altura > 0) {
                $this->altura = $altura;
            } else {
                throw new Exception("Altura do retângulo inválida. Informe um valor maior que 0");
            }
        }

        public function excluir(){
            $sql = 'DELETE FROM retangulo 
                     WHERE id = :id';         
            $param = array(':id'=>$this->getId());         
            return Database::executar($sql, $param);
          }
      
        public function editar(){
            $sql = 'UPDATE retangulo SET largura = :largura, altura = :altura, cor = :cor, un = :un, id_quadro = :id_quadro WHERE id = :id';
            $param = array(
              'id'=>$this->getId(),
              'largura'=>$this->getLargura(),
              'altura'=>$this->getAltura(),
              'cor'=>$this->getCor(),
              'un'=>$this->getUn(),
              'id_quadro'=>$this->getQuadro());
           return Database::executar($sql, $param);
           
        }
      
          public function inserir()
          {   
              $sql = "INSERT INTO retangulo (largura,altura,cor,un,id_quadro) VALUES (:largura,:altura,:cor,:un,:id_quadro)";
              $param = array(
                'largura'=>$this->getLargura(),
                'altura'=>$this->getAltura(),
                'cor'=>$this->getCor(),
                'un'=>$this->getUn(),
                'id_quadro'=>$this->getQuadro());
              return Database::executar($sql,$param);
          }
    
        public static function listar($tipo = 0, $info = ''){
            $sql = 'SELECT * FROM retangulo';
            switch($tipo){
                case 1: $sql .= ' WHERE id = :info'; break;
                case 2: $sql .= ' WHERE cor like :info';  break;
                case 3: $sql .= ' WHERE id_quadro = :info';  break;
            }           
            $params = array();
            if ($tipo > 0)
                $params = array(':info'=>$info);         
            return Database::listar($sql, $params);
          }

        public function buscarTodos() {
            $db = new Database();
            $conexao = $db->criarConexao();
    
            $sql = "SELECT * FROM retangulo";
            $stmt = $conexao->query($sql);
    
            return $stmt;
        }
    
        public function desenhar() {
            $desenho = "<div class='desenho'
                            style='
                                width: {$this->getLargura()}{$this->getUn()};
                                height: {$this->getAltura()}{$this->getUn()};
                                background-color: {$this->getCor()};
                            '>
                        </div>";
    
            return $desenho;
        }
    
        public function calcular() {
            $area = $this->getLargura() * $this->getAltura();
            $perimetro = 2 * ($this->getLargura() + $this->getAltura());
    
            return array('area' => $area, 'perimetro' => $perimetro);
        }
        public function calcularArea(){
            return $this->calcular();
        }
        public function calcularPerimetro(){}
    }
?>
