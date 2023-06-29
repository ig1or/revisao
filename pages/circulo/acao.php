<?php
    require_once('../classes/circulo.class.php');

    $acao = "";
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
            break;
        case 'POST':
            $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
            break;
    }

    $raio = isset($_POST['raio']) ? $_POST['raio'] : '2';
    $cor = isset($_POST['cor']) ? $_POST['cor'] : '#000000';
    $un = isset($_POST['un']) ? $_POST['un'] : 'px';
    $id_quadro = isset($_POST['id_quadro']) ? $_POST['id_quadro'] : '0';

    if ($acao == 'salvar') {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $circulo = new Circulo($id, $raio, $cor, $un, $id_quadro);
        try {
            if ($id == 0) {
                if ($circulo->inserir()) {
                    echo "Deu certo =) <br> Criar";
                    header("Location: index.php?aviso=Cadastrado");
                    exit();
                } else {
                    echo "Deu errado =( <br> Criar";
                    header("Location: index.php?aviso=NaoCadastrado");
                    exit();
                }
            } else {
                try {
                    if ($circulo->editar()) {
                        echo "Deu certo =) <br> Editar";
                        header("Location: index.php?aviso=Editado");
                        exit();
                    } else {
                        echo "Deu errado =( <br> Editar";
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
        $circulo = new Circulo($id, $raio, $cor, $un, $id_quadro);

        try {
            if ($circulo->excluir()) {
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
