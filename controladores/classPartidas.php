<?php

class Partidas{


    public $IDPartida,$IDHost,$IDContrincante,
            $IDEstadoPartida,$nombrePartida,$passwordPartida;


    function __construct($IDPartida,$IDHost,$IDContrincante,$IDEstadoPartida,$nombrePartida,$passwordPartida){

    $this->IDPartida = $IDPartida;
    $this->IDHost = $IDHost;
    $this->IDContrincante = $IDContrincante;
    $this->IDEstadoPartida = $IDEstadoPartida;
    $this->nombrePartida = $nombrePartida;
    $this->passwordPartida = $passwordPartida;

    }


    public function getValues(){
        return $datos = array($this->IDPartida,$this->IDHost,$this->IDContrincante,$this->IDEstadoPartida,$this->nombrePartida,$this->passwordPartida);
    }















}