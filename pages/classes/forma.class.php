<?php
    require_once('database.class.php');
    abstract class Forma{

        private $id = 0;    // int
        private $lado;      // int
        private $cor;       // string
        private $un;        // string
        private $quadro;    // int

        public function __construct($pid, $plado, $pcor, $pun,$pquadro){
            $this->setId($pid);
            $this->setLado($plado);
            $this->setCor($pcor);
            $this->setUn($pun);
            $this->setQuadro($pquadro);
        }

        public function setUn($un){
            if ($un != '')
            $this->un = $un;
            else
            throw new Exception('Unidade de medida inválida. Selecione uma unidade válida.'); 
        }

        /**
         * Essa função retorna a informação da unidade de medida do quadrado
        */
        public function getUn(){
            return $this->un;
        }


        /**
         * GET ID lê a informação do atributo ID
         */
        public function getId(){
            return $this->id;
        }
        /**
         * SET ID define ou altera o valor do atributo ID
         */
        public function setId($id){
            $this->id = $id;
        }

        public function getLado(){
        return $this->lado;
        }

    
        /**
         * SET ID define ou altera o valor do atributo ID
         */

        public function setLado($lado){
        if ($lado > 0)
            $this->lado = $lado;
        else
            throw new Exception('Lado do quadrado inválido. Informe um valor maior que 0.');
            
        }

        public function getCor(){
            return $this->cor;
        }
        /**
         * cor irá vir em hexadecimal
         */
        public function setCor($cor){
        if ($cor != '')
            $this->cor = $cor;
        else
            throw new Exception('Cor do quadrado inválida. Informe uma cor.');         
        }

        /**
         * SET ID define ou altera o valor do atributo ID
         */
        public function getQuadro(){
            return $this->quadro;
        }
        
        public function setQuadro($quadro){
            $this->quadro = $quadro;
        }

        

        public abstract function desenhar();
        public abstract function calcularArea();
        public abstract function calcularPerimetro();
        public abstract function inserir();
        public abstract function excluir();
        public abstract function editar();
    }
?>