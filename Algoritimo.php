<?php

class Algoritimo
{
    protected $tempo = 0;
    protected $espera_tempo = 0;
    protected $espera_total = 0;
    protected $saida = "";

    protected $processes = [];
    protected $toBeProcessed;
    protected $atual_process;
    protected $atual_index;

    public function start(){

    }

    public function execute(){
//        while (count($this->processes) > 0){
//
//        }
    }

    public function conclude(){

    }

    public function getProcessById($id){
        foreach ($this->processes as $process){
            if($process->id == $id)
                return $process;
        }
    }
}