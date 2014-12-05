<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VisitanteModel
 *
 * @author lfnsantos
 */
namespace Src\Model;

class VisitantesModel {
    
    public $erro = false;
    
    public function testNull($campo, $var) {
        if (trim($var) == '' || is_null($var)) {
            $this->erro = true;
            echo "<script>alert(\"O campo ''{$campo}'' não pode ser vazio.\")</script>";
            echo "<script>window.history.go(-1)</script>";
        }
    }
    
    public function testInt($campo, $var) {
        if (!is_numeric($var)) {
            $this->erro = true;
            echo "<script>alert(\"O campo ''{$campo}'' deve ser um número.\")</script>";
            echo "<script>window.history.go(-1)</script>";
        }
    }
}
