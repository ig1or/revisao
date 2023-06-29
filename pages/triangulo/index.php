<?php
    require_once('../../conf/conf.inc.php');
    require_once('../classes/triangulo.class.php');
    require_once('../classes/quadro.class.php');
    require_once('acao.php');

    $triangulo = new Triangulo('1','2','x','x','1','2','s','s');
    $qeditando = null;


    $id = isset($_GET['id'])?$_GET['id']:0;
    if ($id > 0){
        $dados = $triangulo->listar(1,$id);
        $qeditando = new Triangulo($dados[0]['id'],$dados[0]['lado1'],$dados[0]['lado2'],$dados[0]['lado3'],$dados[0]['cor'],$dados[0]['un'],$dados[0]['tipo'],$dados[0]['id_quadro']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Triângulo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <style>
            .desenho{
                border: 1px solid black;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <a href="../../index.php">Voltar</a>
        <h1>Triângulo</h1>
        <div style="margin:5vh;">
            <div>
                <form action="acao.php" method="post">
                    <div>                       
                            <!-- <label for="id">ID</label> -->
                            <input type="hidden" name="id" id="id"   readonly value="<?php echo isset($qeditando)?$qeditando->getId():0 ?>">                       
                        <div>
                            <label for="lado1">Lado 1</label>
                            <input type="text" name="lado1" id="lado1"  value="<?php if($qeditando) echo $qeditando->getLado1(); ?>">
                        </div>
                        <div>
                            <label for="lado2">Lado 2</label>
                            <input type="text" name="lado2" id="lado2"  value="<?php if($qeditando) echo $qeditando->getLado2(); ?>">
                        </div>
                        <div>
                            <label for="lado3">Lado 3</label>
                            <input type="text" name="lado3" id="lado3"  value="<?php if($qeditando) echo $qeditando->getLado3(); ?>">
                        </div>
                        <div>
                            <label for="cor">Cor</label>
                            <input type="color" name="cor" id="cor"  value="<?php  if($qeditando) echo $qeditando->getCor(); ?>"> 
                        </div>
                        <div>
                            <label for="un">Tamanho</label>
                            <select  name="un" id="un">
                                <option value="cm" <?php  if($qeditando) if ($qeditando->getUn() == 'cm') echo 'selected'; ?>>CM - Centímetro</option>
                                <option value="px" <?php  if($qeditando) if ($qeditando->getUn() == 'px') echo 'selected'; ?>>PX - Píxel</option>
                                <option value="%" <?php  if($qeditando) if ($qeditando->getUn() == '%') echo 'selected'; ?>>% - Porcentagem</option>
                                <option value="vh" <?php  if($qeditando) if ($qeditando->getUn() == 'vh') echo 'selected'; ?>>VH - Viewport Height</option>
                                <option value="vw" <?php  if($qeditando) if ($qeditando->getUn() == 'vw') echo 'selected'; ?>>VW - Viewport Width</option>
                            </select>
                        </div>
                        <div>
                            <label for="tipo">Tipo de Triângulo</label>
                            <select name="tipo" id="tipo" >
                                <option value="">Selecione</option>
                                <option value="Retângulo" <?php  if($qeditando) if ($qeditando->getTipo() == 'Retângulo') echo 'selected'; ?>>Triângulo Retângulo</option>
                                <option value="Equilátero" <?php  if($qeditando) if ($qeditando->getTipo() == 'Equilátero') echo 'selected'; ?>>Triângulo Equilátero</option>
                                <option value="Isósceles" <?php  if($qeditando) if ($qeditando->getTipo() == 'Isósceles') echo 'selected'; ?>>Triângulo Isósceles</option>
                                <option value="Escaleno" <?php  if($qeditando) if ($qeditando->getTipo() == 'Escaleno') echo 'selected'; ?>>Triângulo Escaleno</option>
                            </select>
                        </div>
                        <div>
                            <label for="id_quadro">Quadro</label>
                            <select  name="id_quadro" id="id_quadro">
                                <?php
                                $quadro = new Quadro("", "");
                                $lista = $quadro->listar();
                                foreach ($lista as $item) {
                                    $selected = '';
                                    if ($qeditando) {
                                        if ($qeditando->getQuadro() == $item['id']) {
                                            $selected = 'selected';
                                        }
                                    }
                                    echo "<option value='". $item['id'] ."' $selected>". $item['nome'] ." (". $item['id'] .")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div style="margin-top: 1vh;">
                            
                                <button type="submit" name="acao" value="salvar"><?= ($qeditando) ? 'Editar' : 'Criar'; ?></button>
                            
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lado 1</th>
                            <th>Lado 2</th>
                            <th>Lado 3</th>
                            <th>Cor</th>
                            <th>Unidade</th>
                            <th>Tipo</th>
                            <th>Quadro</th>
                            <th>Desenho</th>
                            <th>Editar/Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $lista = $triangulo->listar();
                        foreach ($lista as $item) {
                            $q = new Triangulo($item['id'],$item['lado1'],$item['lado2'],$item['lado3'],$item['cor'],$item['un'],$item['tipo'],$item['id_quadro']);
                            $perimetro = $q->calcularPerimetro();
                            $area = $q->calcularArea();

                            echo '<tr>
                                <td>' . $q->getId() . '</td>
                                <td>' . $q->getLado1() . '</td>
                                <td>' . $q->getLado2() . '</td>
                                <td>' . $q->getLado3() . '</td>
                                <td>' . $q->getCor() . '</td>
                                <td>' . $q->getUn() . '</td>
                                <td>' . $q->getTipo() . '</td>
                                <td>' . $q->getQuadro() . '</td>
                                <td>' . $q->desenhar() . ' Perimetro: ' . $perimetro . ' Area: ' . $area .'</td>
                                <td>
                                    <a  href="index.php?acao=editar&id=' . $q->getId() . '">Editar</a>
                                    <a  href="acao.php?acao=excluir&id=' . $q->getId() . '">Excluir</a>
                                </td>
                            </tr>';
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>