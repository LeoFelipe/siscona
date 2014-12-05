<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleAcesso
 *
 * @author lfnsantos
 */

namespace Src\Controller;

class IndexController {
    //put your code here
    
    public function index()
    {
        $actionDAO = new \Src\DAO\VisitantesDAO();
        $visitantes = $actionDAO->listar();
        $setores = $actionDAO->listarAllSetores();
        //die(var_dump($visitantes));
        require_once TEMPLATES . 'index.phtml';
    }
    
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            
            $visitante = new \Src\Entidade\Visitantes();
            $visitante->setCracha($_POST['cracha']);
            $visitante->setRg($_POST['rg']);
            $visitante->setNome($_POST['nome']);
            $visitante->setSetorId($_POST['setorId']);

            $visitanteModel = new \Src\Model\VisitantesModel();
            $visitanteModel->testNull('Rg', $visitante->getRg());
            $visitanteModel->testInt('Rg', $visitante->getRg());
            $visitanteModel->testNull('Crachá', $visitante->getCracha());
            $visitanteModel->testInt('Crachá', $visitante->getCracha());
            $visitanteModel->testNull('Nome', $visitante->getNome());
            $visitanteModel->testInt('Setor', (int)$visitante->getSetorId());
            
            if (!$visitanteModel->erro) {
                $visitanteDAO = new \Src\DAO\VisitantesDAO();
                if($visitanteDAO->cadastrar($visitante)) {
                    echo "<script>alert(\"Cadastrado com Sucesso!\")</script>";
                    echo "<script>window.location = '" . ROOT . $GLOBALS['controller'] . "'</script>";
                }
            } else {
                echo "<script>alert(\"Erro ao cadastrar. Por favor tente novamente.\")</script>";
                echo "<script>window.location = '" . ROOT . $GLOBALS['controller'] . "'</script>";
            }
        }
    }
    
    public function liberarVisitante()
    {
        if (!$id = (int)$GLOBALS['explode'][3]) {
            echo "<script>alert(\"Um Id não foi informado. Por favor novamente.\")</script>";
            echo "<script>window.location = '" . ROOT . $GLOBALS['controller'] . "'</script>";
        }
        
        $visitante = new \Src\Entidade\Visitantes();
        $visitante->setId($id);
        
        $visitanteModel = new \Src\Model\VisitantesModel();
        $visitanteModel->testNull('ID', $visitante->getId());
        $visitanteModel->testInt('ID', $visitante->getId());
        
        if (!$visitanteModel->erro) {
            $visitanteDAO = new \Src\DAO\VisitantesDAO();
            if($visitanteDAO->liberarVisitante($visitante)) {
                echo "<script>alert(\"O Visitante foi liberado com sucesso!\")</script>";
                echo "<script>window.location = '" . ROOT . $GLOBALS['controller'] . "'</script>";
            }
        } else {
            echo "<script>alert(\"Erro ao liberar visitante no sistema. Por favor tente novamente.\")</script>";
            echo "<script>window.location = '" . ROOT . $GLOBALS['controller'] . "'</script>";
        }
    }
}
