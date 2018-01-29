<?php

/**
 * Created by PhpStorm.
 * User: Lopeare
 * Date: 12/04/2017
 * Time: 16:58
 */
class DataUsuario
{
    private $dataBase;

    public function DataUsuario( $dataBase ){
        $this->dataBase = $dataBase;
    }

    public function check( $user, $pssw ){
        $userResult = $this->dataBase->user($user);
        $psswResult = $this->dataBase->pssw($pssw);

        return $userResult->fetch_assoc() > 0 && $psswResult->fetch_assoc() > 0;
    }

    public function checkGest( $user, $pssw ){
        $userResult = $this->dataBase->userGest($user)->fetch_assoc();
        $psswResult = $this->dataBase->psswGest($pssw)->fetch_assoc();

        return $userResult > 0 && $psswResult > 0;
    }

    public function checkEditor($user){
        $result = $this->dataBase->checkEditor($user);
        return $result->fetch_assoc() > 0;
    }

    public function getAllUsers(){
        $resultUsuarios = $this->dataBase->getResultAllUsers();
        return $this->buildUsuario($resultUsuarios);
    }

    public function buildUsuario($resultUsuarios){
        $usuarios = array();
        while( $row = $resultUsuarios->fetch_assoc()){
            array_push($usuarios, new Usuario($row));
        }
        return $usuarios;
    }
}