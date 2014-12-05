<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContAcesso
 *
 * @author lfnsantos
 */
namespace Src\Entidade;

class Visitantes {
    
    private $id;
    private $cracha;
    private $rg;
    private $nome;
    private $setorId;
    
    public function getId() {
        return $this->id;
    }

    public function getRg() {
        return $this->rg;
    }
    public function getCracha() {
        return $this->cracha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSetorId() {
        return $this->setorId;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setCracha($cracha) {
        $this->cracha = $cracha;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSetorId($setorId) {
        $this->setorId = $setorId;
    }
}
