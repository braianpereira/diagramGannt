<?php

class Process
{
    public $id;
    public $unidade_tempo;
    public $espera_tempo;
    public $tempo_chegada;

    public function __construct($id, $unidade_tempo, $tempo_chegada = 0)
    {
        $this->id = $id;
        $this->unidade_tempo = $unidade_tempo;
        $this->tempo_chegada =$tempo_chegada;
    }
}