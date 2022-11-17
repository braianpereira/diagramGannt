<?php

require "Fcfs.php";
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

        for($i = 0; $i < $processNumber; $i++){
            if($inputType == '1'){
                $ut = rand(1,5);
            } else {
                echo "Informe o tempo de execução para o processo (p" . $i+1 ."): ";
                $ut = trim(fgets($this->handle));
            }

            $this->processes[] = new Process($i, $ut);
        }
    }

    function build() {
        echo "\n";

        do{
            echo "\n***** ESCOLHA O TIPO DE ALGORITMO ***** \n";
            echo "1) FCFS \n";
            echo "2) SJF \n";
            echo "2) SJF P \n";
            echo "7) Sair \n";

            $inputType = trim(fgets($this->handle));

            switch ($inputType){
                case 1:
                    $fcfs = new Fcfs($this->processes);
                    $fcfs->start();
                    $fcfs->execute();
                    $fcfs->conclude();
                    break;
                case 7: echo "Tcheu Tchau\n"; break;
                default: echo "Função ainda não implementada\n"; break;

            }
        } while ($inputType <> '7');
    }
}

