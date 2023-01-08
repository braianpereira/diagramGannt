<?php

require "Fcfs.php";
require "Sjf.php";
require "Robin.php";
require "Process.php";

$gannt = new Gannt();

class Gannt {
    public $handle;
    public $processes = [];

    public function __construct()
    {
        $this->handle = fopen ("php://stdin","r");

        do {
            $this->start();

            $this->build();

            echo "Reinicar(S/N)?";

            do{
                $inputType = trim(fgets($this->handle));
            }while(in_array(!$inputType, ['S', 's', 'N', 'n']));

        } while(in_array($inputType, ['S', 's']));
    }


    function start() {
        echo "Quantos processos:";

        $processNumber = trim(fgets($this->handle));

        do{
            echo "\nOpções \n";
            echo "1) Aleatório \n";
            echo "2) Manual \n";
            echo "\nOpção: ";

            $inputType = trim(fgets($this->handle));
        } while ($inputType <> '1' && $inputType <> '2');

        $tc = 0;
        $prioridade = 0;

        for($i = 0; $i < $processNumber; $i++){
            if($inputType == '1'){
                if($i > 0) {
                    $tc += rand(1, 5);
                    $prioridade += rand(20,50);
                }
                $ut = rand(1,5);

            } else {
                echo "Informe o tempo de execução para o processo (p" . $i+1 ."): ";
                $ut = trim(fgets($this->handle));

                echo "Informe o tempo de chegada para o processo (p" . $i+1 ."): ";
                $tc = trim(fgets($this->handle));

//                echo "Informe a prioridade para o processo (p" . $i+1 ."): ";
//                $prioridade = trim(fgets($this->handle));
            }

            $this->processes[] = new Process($i, $ut, $tc, $prioridade);
        }
    }

    function build() {
        echo "\n";

        do{
            echo "\n***** ESCOLHA O TIPO DE ALGORITMO ***** \n";
            echo "1) FCFS \n";
            echo "2) SJF \n";
            echo "3) SJF P \n";
            echo "4) ROBIN \n";
            echo "5) PRIORIDADE \n";
            echo "6) PRIORIDADE P \n";
            echo "7) Sair \n";

            $inputType = trim(fgets($this->handle));

            switch ($inputType){
                case 1:
                    $fcfs = new Fcfs($this->processes);
                    $fcfs->start();
                    $fcfs->execute();
                    $fcfs->conclude();
                    break;
                case 2:
                    $sjf = new Sjf($this->newProcessess());
                    $sjf->start();
                    $sjf->execute();
                    $sjf->conclude();
                    break;
                case 3:
                    $sjf = new Sjf($this->newProcessess(), true);
                    $sjf->start();
                    $sjf->execute();
                    $sjf->conclude();
                    break;
                case 4:
                    $rr = new Robin($this->newProcessess(), true);
                    $rr->start();
                    $rr->execute();
                    $rr->conclude();
                    break;
                case 7: echo "Tcheu Tchau\n"; break;
                default: echo "Função ainda não implementada\n"; break;

            }
        } while ($inputType <> '7');
    }

    function newProcessess(){
        $new = array();

        foreach ($this->processes as $k => $v) {
            $new[$k] = clone $v;
        }

        return $new;
    }
}

