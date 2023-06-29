<?php
require_once('conf/conf.inc.php');
require_once('pages/classes/quadro.class.php');

function cadastrarQuadro($nome) {
    $quadro = new Quadro(0, $nome);
    try {  
        if ($quadro->inserir()) {
            header("Location: index.php?aviso=Cadastrado");
            exit();
        } else {
            header("Location: index.php?aviso=NaoCadastrado");
            exit();
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function editarQuadro($id, $nome) {
    $quadro = new Quadro($id, $nome);
    try {
        if ($quadro->editar()) {
            header("Location: index.php?aviso=Editado");
            exit();
        } else {
            header("Location: index.php?aviso=NaoEditado");
            exit();
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function excluirQuadro($id) {
    $quadro = new Quadro($id, '');
    try {
        if ($quadro->excluir()) {
            header("Location: index.php?aviso=Excluido");
            exit();
        } else {
            header("Location: index.php?aviso=NaoExcluido");
            exit();
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Roteamento de ações
$acao = $_GET['acao'] ?? '';
switch ($acao) {
    case 'salvar':
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        if ($id == 0) {
            cadastrarQuadro($nome);
        } else {
            editarQuadro($id, $nome);
        }
        break;
    case 'excluir':
        $id = $_GET['id'] ?? 0;
        excluirQuadro($id);
        break;
}
?>

