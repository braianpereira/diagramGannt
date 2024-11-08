<?php

class Prioridade extends Algoritimo
{
    protected $preemptive;

    public function __construct($processes, $preemptive = false)
    {
        $this->processes = $processes;
        $this->toBeProcessed = count($processes);
        $this->preemptive = $preemptive;
    }

    public function execute()
    {
        echo "RESULTADO\n";
        $execucao = "";

        $this->setNextProcess();

        do {
            if($this->atual_process->tempo_chegada <= $this->tempo && $this->atual_process->tempo_restante > 0){
                $execucao .= "\n";
                $execucao .= (str_pad($this->tempo, 3, "0", 0) . ": p") . ($this->atual_process->id + 1);
                $this->atual_process->tempo_restante--;

                if($this->atual_process->tempo_restante == 0)
                    $this->toBeProcessed--;
            } else {
                $execucao .= "\n";
                $execucao .= str_pad($this->tempo, 3, "0", 0) .": - ";
            }

            foreach ($this->processes as $k => $process) {
                if($k <> $this->atual_index && $process->tempo_chegada <= $this->tempo && $this->processes[$k]->tempo_restante > 0) {
                    $this->processes[$k]->espera_tempo++;
                }
            }

            $this->tempo++;

            if($this->atual_process->tempo_restante == 0 || $this->preemptive){
                $this->setNextProcess();
            }
        } while($this->toBeProcessed > 0);

        foreach ($this->processes as $process) {

            $this->espera_total += $process->espera_tempo;

            $p = $process->id + 1;

            echo  "------------------------\n";
            echo "ID : p$p EXECUÇÃO : $process->unidade_tempo ESPERA :".
            "$process->espera_tempo CHEGADA: $process->tempo_chegada ".
            "PRIORIDADE: $process->prioridade \n";
        }

        echo $execucao;

        echo "\n\nMédia Espera: " . $this->espera_total/count($this->processes) ."\n";
    }

    public function setNextProcess(){
        $p = null;
        $i = null;
        foreach ($this->processes as $k => $process){
            if(is_null($p) && $process->tempo_restante > 0) {
                $p = $process;
                $i = $k;
                continue;
            }

            if($this->tempo >= $process->tempo_chegada &&
                $process->tempo_restante > 0 &&
                $process->prioridade > $p->prioridade){
                $p = $process;
                $i = $k;
            }

        }

        $this->atual_process = $p;
        $this->atual_index =$i;
    }
}