<?php
    require_once('../../conf/conf.inc.php');
    require_once('../classes/quadrado.class.php');
    require_once('../classes/quadro.class.php');
    require_once('acao.php');

    $quadrado = new Quadrado(6, 45, '#0000', 'px', 1, 'example');

    $qeditando = null;


    $id = isset($_GET['id'])?$_GET['id']:0;
    if ($id > 0){
        $dados = $quadrado->listar(1,$id);
        $qeditando = new Quadrado($dados[0]['id'],$dados[0]['lado'],$dados[0]['cor'],$dados[0]['un'],$dados[0]['id_quadro']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Quadrado</title>
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
        <a href="../../index.php" >Voltar</a>
       <h1>Quadrado</h1>
        <div  style="margin:5vh;">
            <div>
                <form action="acao.php" method="post">
                    <div class="row">                       
                            <!-- <label for="id">ID</label> -->
                            <input type="hidden" name="id" id="id"  readonly value="<?php echo isset($qeditando)?$qeditando->getId():0 ?>">                       
                        <div>
                            <label for="lado">Lado</label>
                            <input type="text" name="lado" id="lado" value="<?php if($qeditando) echo $qeditando->getLado(); ?>">
                        </div>
                        <div>
                            <label for="cor">Cor</label>
                            <input type="color" name="cor" id="cor" value="<?php  if($qeditando) echo $qeditando->getCor(); ?>"> 
                        </div>
                        <div>
                            <label for="un">Tamanho</label>
                            <select name="un" id="un">
                                <option value="cm" <?php  if($qeditando) if ($qeditando->getUn() == 'cm') echo 'selected'; ?>>CM - Centímetro</option>
                                <option value="px" <?php  if($qeditando) if ($qeditando->getUn() == 'px') echo 'selected'; ?>>PX - Píxel</option>
                                <option value="%" <?php  if($qeditando) if ($qeditando->getUn() == '%') echo 'selected'; ?>>% - Porcentagem</option>
                                <option value="vh" <?php  if($qeditando) if ($qeditando->getUn() == 'vh') echo 'selected'; ?>>VH - Viewport Height</option>
                                <option value="vw" <?php  if($qeditando) if ($qeditando->getUn() == 'vw') echo 'selected'; ?>>VW - Viewport Width</option>
                            </select>
                        </div>
                        <div>
                            <label for="id_quadro">Quadro</label>
                            <select name="id_quadro" id="id_quadro">
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
                           
                                <button type="submit"  name="acao" value="salvar"><?= ($qeditando) ? 'Editar' : 'Criar'; ?></button>
                            
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lado</th>
                            <th>Cor</th>
                            <th>Unidade</th>
                            <th>Quadro</th>
                            <th>Desenho</th>                            
                            <th>Editat/Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $lista = $quadrado->listar();
                        foreach ($lista as $item) {
                            $q = new Quadrado($item['id'], $item['lado'], $item['cor'], $item['un'], $item['id_quadro']);
                            $area = $q->calcularArea();
                            $perimetro = $q->calcularPerimetro();

                            echo '<tr>
                                <td>' . $q->getId() . '</td>
                                <td>' . $q->getLado() . '</td>
                                <td>' . $q->getCor() . '</td>
                                <td>' . $q->getUn() . '</td>
                                <td>' . $q->getQuadro() . '</td>
                                <td>' . $q->desenhar() . ' <br>                                
                                Área: ' . $area . '<br>Perímetro: ' . $perimetro . '</td>
                                <td>
                                    <a href="index.php?acao=editar&id=' . $q->getId() . '">Editar</a>
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