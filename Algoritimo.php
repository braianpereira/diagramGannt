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

    public function execute(){ }
}