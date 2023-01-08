<?php

class Process
{
    public $id;
    public $unidade_tempo;
    public $tempo_restante;
    public $espera_tempo;
    public $tempo_chegada;
    public $prioridade;

    public function __construct($id, $unidade_tempo, $tempo_chegada = 0, $prioridade = 0)
    {
        $this->id = $id;
        $this->unidade_tempo = $unidade_tempo;
        $this->tempo_restante = $unidade_tempo;
        $this->tempo_chegada = $tempo_chegada;
        $this->prioridade = $prioridade;
        $this->espera_tempo = 0;
    }
}