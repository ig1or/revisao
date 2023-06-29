<?php
require_once('pages/classes/quadro.class.php');
require_once('acao.php');

$quadro = new Quadro(1, '#00000');

$qeditando = null;

$id = isset($_GET['id']) ? $_GET['id'] : 0;
if ($id > 0) {
    $dados = $quadro->listar(1, $id);
    $qeditando = new Quadro($dados[0]['id'], $dados[0]['nome']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Quadro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body> 
        <nav> 
            <a href="pages/quadrado/index.php">Quadrado</a>
            <a href="pages/triangulo/index.php">Triângulo</a>
            <a href="pages/circulo/index.php">Círculo</a>
            <a href="pages/retangulo/index.php">Retângulo</a>
        </nav>
    <div>
        <h1>Quadro</h1>
        <form action="acao.php" method="post">
            <input type="hidden" name="id" value="<?php echo isset($qeditando) ? $qeditando->getId() : 0 ?>">
            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if ($qeditando) echo $qeditando->getNome(); ?>">
            </div>
            <button type="submit" name="acao" value="salvar"><?= ($qeditando) ? 'Editar' : 'Criar '; ?></button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID - </th>
                    <th>Nome - </th>
                    <th>Cor - </th>
                    <th>Unidade - </th>
                    <th>Desenho - </th> 
                    <th>Editar/Excluir -</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lista = $quadro->listar();
                foreach ($lista as $item) {
                    $q = new Quadro($item['id'], $item['nome']);
                    foreach ($q->getFormas() as $forma) {
                        echo '<tr>
                                <td>' . $q->getId() . '</td>
                                <td>' . $q->getNome() . '</td>
                                <td>' . $forma->getCor() . '</td>
                                <td>' . $forma->getUn() . '</td>
                                <td>' . $forma->desenhar() . '</td>
                                <td>
                                    <a href="index.php?acao=editar&id=' . $q->getId() . '">Editar</a>
                                    <a href="acao.php?acao=excluir&id=' . $q->getId() . '">Excluir</a>
                                </td>
                            </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
