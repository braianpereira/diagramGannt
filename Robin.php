<?php

class Robin extends Algoritimo
{
    const CICLO = 20;
    public function __construct($processes)
    {
        $this->processes = $processes;
        $this->toBeProcessed = count($processes);
    }

    public function execute()
    {
        parent::execute();
        echo "RESULTADO\n";
        $execucao = "";
        ;
        $this->atual_index = 0;
        $this->atual_process = $this->processes[0];

        do {
            $ciclo = self::CICLO;



            while($ciclo > 0 && $this->atual_process->tempo_restante > 0){

                $this->atual_process->tempo_restante--;

                $this->tempo++;

                $ciclo--;
            }

            $execucao .= "\n";
            $execucao .= (str_pad($this->tempo, 3, "0", 0) . ": p") . ($this->atual_process->id + 1);

            if($this->atual_process->tempo_restante == 0)
                $this->toBeProcessed--;


            foreach ($this->processes as $k => $process) {
                if($k <> $this->atual_index && $this->processes[$k]->tempo_restante > 0) {
                    $this->processes[$k]->espera_tempo += self::CICLO - $ciclo;
                }
            }

            if($this->toBeProcessed > 0)
                $this->setNextProcess();

        } while($this->toBeProcessed > 0);

        foreach ($this->processes as $process) {

            $this->espera_total += $process->espera_tempo;

            $p = $process->id + 1;

            echo  "------------------------\n";
            echo "ID : p$p EXECUÇÃO : $process->unidade_tempo ESPERA : $process->espera_tempo  \n";
        }

        echo $execucao;

        echo "\n\nMédia Espera: " . $this->espera_total/count($this->processes) ."\n";
    }

    public function setNextProcess(){
        $p = null;
        $i = $this->atual_index + 1;

        if($i >= count($this->processes)) {
            $i = 0;
        }

        while (is_null($p)){
            if($i < count($this->processes) && $this->processes[$i]->tempo_restante > 0 )
                $p = $this->processes[$i];

            $i++;
        }

        $this->atual_process = $p;
        $this->atual_index = $i;
    }
}