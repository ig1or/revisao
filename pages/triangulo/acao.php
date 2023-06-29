<?php
    require_once('../classes/triangulo.class.php');

    $acao = "";
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
            break;
        case 'POST':
            $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
            break;
    }
    
    $lado1 = isset($_POST['lado1']) ? $_POST['lado1'] : '2';
    $lado2 = isset($_POST['lado2']) ? $_POST['lado2'] : '2';
    $lado3 = isset($_POST['lado3']) ? $_POST['lado3'] : '2';
    $cor = isset($_POST['cor']) ? $_POST['cor'] : '#000000';
    $un = isset($_POST['un']) ? $_POST['un'] : '2';
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $id_quadro = isset($_POST['id_quadro']) ? $_POST['id_quadro'] : 0;


    if ($acao == 'salvar') {
        $id = isset($_POST['id']) ? $_POST['id'] : 0; 
        $triangulo = new Triangulo($id, $lado1, $lado2, $lado3, $cor, $un, $tipo,$id_quadro);
        try {  
            if ($id == 0) {
                if ($triangulo->inserir()) {
                    echo "Funcionou =) <br> Criar";
                    header("Location: index.php?aviso=Cadastrado");
                    exit();
                } else {
                    echo "Não funcionou =( <br> Criar";
                    header("Location: index.php?aviso=NaoCadastrado");
                    exit();
                }
            } else {
                try {
                    if ($triangulo->editar()) {
                        echo "Funcionou =) <br> Editar";
                        header("Location: index.php?aviso=Editado");
                        exit();
                    } else {
                        echo "Não funcionou =( <br> Editar";
                        header("Location: index.php?aviso=NaoEditado");
                        exit();
                    }
                } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else if ($acao == 'excluir') {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $triangulo = new Triangulo($id, $lado1, $lado2, $lado3, $cor, $un, $tipo,$id_quadro);

        try {
            if ($triangulo->excluir()) {
                echo "Deu certo =) <br> Excluir";
                header("Location: index.php?aviso=Excluido");
                exit();
            } else {
                echo "Deu errado =( <br> Excluir";
                header("Location: index.php?aviso=NaoExcluido");
                exit();
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
?>
