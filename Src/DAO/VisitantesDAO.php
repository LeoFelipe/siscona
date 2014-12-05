<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VisitantesDAO
 *
 * @author lfnsantos
 */
namespace Src\DAO;

class VisitantesDAO extends \Src\Config\DBConnection
{
    public function listar()
    {
        $sql = "SELECT v.*, s.nome as setor
                FROM visitantes v LEFT JOIN setores s ON(v.setor_id = s.id)
                ORDER BY v.id DESC";
        
//        $sql = "SELECT v.*, s.nome as setor
//                FROM visitantes v LEFT JOIN setores s ON(v.setor_id = s.id)
//                WHERE DATE(dt_entrada) = DATE(NOW())
//                ORDER BY v.id DESC";

        try {
            $db = new \Src\Config\DBConnection();
            $stmt = $db->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo 'Houve um erro ao consultar: ' . $e->getMessage();
        }
    }
    
    public function listarAllSetores()
    {
        $sql = "SELECT * FROM setores ORDER BY nome DESC";

        try {
            $db = new \Src\Config\DBConnection();
            $stmt = $db->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo 'Houve um erro ao consultar: ' . $e->getMessage();
        }
    }
    
    public function cadastrar(\Src\Entidade\Visitantes $entidade)
    {
        $sql = "INSERT INTO visitantes (cracha, rg, nome, setor_id, dt_entrada)
                                VALUES (:cracha, :rg, :nome, :setor_id, NOW())";
        
        $param['cracha'] = $entidade->getCracha();
        $param['rg'] = $entidade->getRg();
        $param['nome'] = $entidade->getNome();
        $param['setorId'] = $entidade->getSetorId();
        //var_dump($param);
        
        try {
            $db = new \Src\Config\DBConnection();
            $stmt = $db->conn->prepare($sql);
            
            $stmt->bindParam(':cracha', $param['cracha']);
            $stmt->bindParam(':rg', $param['rg']);
            $stmt->bindParam(':nome', $param['nome']);
            $stmt->bindParam(':setor_id', $param['setorId']);
            //die(var_dump($stmt));
            return $stmt->execute();;
        }
        catch (PDOException $e)
        {
            echo 'Houve um erro ao inserir: ' . $e->getMessage();
        }
    }
    
    public function liberarVisitante(\Src\Entidade\Visitantes $entidade)
    {
        $sql = "UPDATE visitantes SET dt_saida = NOW() WHERE id = :id";
        
        $id = $entidade->getId();
            
        try {
            $db = new \Src\Config\DBConnection();
            $stmt = $db->conn->prepare($sql);
            
            $stmt->bindParam(':id', $id);
            //die(var_dump($stmt));
            return $stmt->execute();;
        }
        catch (PDOException $e)
        {
            echo 'Houve um erro ao inserir: ' . $e->getMessage();
        }
    }
}
