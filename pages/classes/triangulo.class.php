<?php
    require_once('forma.class.php');

class Triangulo extends Forma {
    private $lado1;
    private $lado2;
    private $lado3;

    public function __construct($pid, $plado1, $plado2, $plado3, $pcor,$pun, $ptipo,$pquadro) {
        parent::__construct($pid, $plado1, $pcor, $pun,$pquadro);
        $this->setLado1($plado1);
        $this->setLado2($plado2);
        $this->setLado3($plado3);
        $this->setTipo($ptipo);
    }
    public function excluir(){
      $sql = 'DELETE FROM triangulo 
               WHERE id = :id';         
      $param = array(':id'=>$this->getId());         
      return Database::executar($sql, $param);
    }

  public function editar(){
      $sql = 'UPDATE triangulo SET lado1 = :lado1, lado2 = :lado2, lado3 = :lado3, cor = :cor, un = :un, tipo = :tipo, id_quadro = :id_quadro WHERE id = :id';
      $param = array(
        'id'=>$this->getId(),
        'lado1'=>$this->getLado1(),
        'lado2'=>$this->getLado2(),
        'lado3'=>$this->getLado3(),
        'cor'=>$this->getCor(),
        'un'=>$this->getUn(),
        'tipo'=>$this->getTipo(),
        'id_quadro'=>$this->getQuadro());
     return Database::executar($sql, $param);
     
  }

    public function inserir()
    {   
        $sql = "INSERT INTO TRIANGULO (lado1,lado2,lado3,cor,un,tipo,id_quadro) VALUES (:lado1,:lado2,:lado3,:cor,:un,:tipo,:id_quadro)";
        $param = array(
          'lado1'=>$this->getLado1(),
          'lado2'=>$this->getLado2(),
          'lado3'=>$this->getLado3(),
          'cor'=>$this->getCor(),
          'un'=>$this->getUn(),
          'tipo'=>$this->getTipo(),
          'id_quadro'=>$this->getQuadro());
        return Database::executar($sql,$param);
    }

    public function getLado1() {
        return $this->lado1;
    }

    public function setLado1($lado1) {
        if ($lado1 > 0) {
            $this->lado1 = $lado1;
        } else {
            throw new Exception("Lado do triângulo inválido. Informe um valor maior que 0");
        }
    }

    public function getLado2() {
        return $this->lado2;
    }

    public function setLado2($lado2) {
        if ($lado2 > 0) {
            $this->lado2 = $lado2;
        } else {
            throw new Exception("Lado do triângulo inválido. Informe um valor maior que 0");
        }
    }

    public function getLado3() {
        return $this->lado3;
    }

    public function setLado3($lado3) {
        if ($lado3 > 0) {
            $this->lado3 = $lado3;
        } else {
            throw new Exception("Lado do triângulo inválido. Informe um valor maior que 0");
        }
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public static function listar($tipo = 0, $info = ''){
      $sql = 'SELECT * FROM triangulo';
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

    public function calcularPerimetro() {
        return $this->lado1 + $this->lado2 + $this->lado3;
    }

    public function calcularArea() {
        $semiperimetro = $this->calcularPerimetro() / 2;
        $area = sqrt($semiperimetro * ($semiperimetro - $this->lado1) * ($semiperimetro - $this->lado2) * ($semiperimetro - $this->lado3));
        return $area;
    }
    

    public function desenhar() {
        $tipo = $this->getTipo();

        switch ($tipo) {
            case 'Retângulo':
                $maiorLado = max($this->lado1, $this->lado2, $this->lado3);
                $hipotenusa = sqrt(pow($this->lado1, 2) + pow($this->lado2, 2));
                $altura = $hipotenusa;
                $base = min($this->lado1, $this->lado2, $this->lado3);

                $desenho = "<div class='desenho'
                                style='
                                    width: 0;
                                    height: 0;
                                    border-left: {$base}px solid transparent;
                                    border-right: {$altura}px solid transparent;
                                    border-bottom: {$maiorLado}px solid {$this->getCor()};
                                    border-top: 0;
                                '>
                            </div>";
                break;

            case 'Equilátero':
                $lado = $this->lado1;
                $altura = ($lado * sqrt(3)) / 2;
                $ladoA = $lado/2;
                $desenho = "<div class='desenho'
                                style='
                                    width: 0;
                                    height: 0;
                                    border-left: {$ladoA}px solid transparent;
                                    border-right: {$ladoA}px solid transparent;
                                    border-bottom: {$altura}px solid {$this->getCor()};
                                    border-top: 0;
                                '>
                            </div>";
                break;

            case 'Isósceles':
                $maiorLado = max($this->lado1, $this->lado2, $this->lado3);
                $base = min($this->lado1, $this->lado2, $this->lado3);
                $altura = sqrt(pow($maiorLado, 2) - pow($base, 2));
                $desenho = "<div class='desenho'
                                style='
                                    width: 0;
                                    height: 0;
                                    border-left: {$base}px solid transparent;
                                    border-right: {$base}px solid transparent;
                                    border-bottom: {$altura}px solid {$this->getCor()};
                                    border-top: 0;
                                '>
                            </div>";
                break;

            case 'Escaleno':
                $perimetro = $this->calcularPerimetro();
                $p = $perimetro / 2;
                $area = sqrt($p * ($p - $this->lado1) * ($p - $this->lado2) * ($p - $this->lado3));

                $desenho = "<div class='desenho'
                                style='
                                    width: 0;
                                    height: 0;
                                    border-left: {$this->lado1}px solid transparent;
                                    border-right: {$this->lado2}px solid transparent;
                                    border-bottom: {$this->lado3}px solid {$this->getCor()};
                                    border-top: 0;
                                '>
                            </div>";
                break;

            default:
                $desenho = "<div class='desenho'>
                                Tipo de triângulo inválido.
                            </div>";
                break;
        }

        return $desenho;
    }
}
