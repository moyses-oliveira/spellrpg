<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SandboxCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sandbox';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $this->probb(3, 6, )
//        $options = $this->rollDice($d,10);
//        foreach ($options as $roll)
//            echo json_encode($roll) . PHP_EOL;
//
//
//
        $sides = 10;
        $dmin = round($sides/2) - 1;
        for ($dices = 3;$dices < 4;$dices++):
            $this->info(implode(' | ', ['N', 'D', 'm', 'prob']));
            for ($min=1;$min <= $dices*2; $min++):
                for ($dif=$dmin;$dif <= $sides; $dif++):
                    $p = $this->successProb($dices, $sides, $dif, $min);
                    $this->info(implode(' | ', [$dices, $dif, $min, number_format($p, 3)]));
                endfor;
            endfor;
        endfor;
        return 0;
    }

    public function successProb(int $dices, int $sides, int $dif, int $min) {
        $count = 0;
        $N = 1000000;

        for ($i = 0; $i < $N; $i++):
            $pontos = 0;
            for ($j = 0; $j < $dices; $j++):
                $roll = rand(1, $sides);
                if ($roll >= $dif && $roll < $sides):
                    $pontos += 1;
                elseif ($roll == $sides):
                    $pontos += 2;
                endif;
            endfor;
            if ($pontos >= $min)
                $count++;

        endfor;

        return round(100 * $count / $N, 6);
    }

    public function prob(int $dices, int $sides, int $dif, int $minResults): float
    {
        $options = $this->rollDice($dices, $sides);
        $success = 0;
        foreach ($options as $roll):
            $r = collect($roll)->map(function ($value) use ($sides, $dif) {
                return $this->getResult($sides, $dif, $value);
            })->sum();
            if ($r >= $minResults)
                $success++;

        endforeach;
        return $success / count($options);
    }

    public function getResult(int $sides, int $dif, int $value): int
    {
        return $value < $dif ? 0 : ($sides === $value ? 1 : 1);
    }

    public function rollDice($numDice, $sides): array
    {
        $options = [];
        $results = array_fill(0, $numDice, 1);
        for ($s = 1; $s <= $sides; $s++):
            for ($i = 0; $i < $numDice; $i++):
                $results[$i] = $s;
                $options[] = $results;
                if ($s === 1)
                    break;
            endfor;
        endfor;
        return $options;
    }

    function probb(int $dices, int $sides, int $dificult, int $min)
    {
        $probabilidade = 0;
        for ($k = ceil($dices / 2); $k <= $dices; $k++) {
            if ($k >= $min) {
                $p = $this->binom($dices, $k) * (pow(($sides - $dificult) / $sides, $dices - $k)) * (pow($dificult / $sides, $k - $dices));
                if ($k <= $dices - 2) {
                    $p += $this->binom($dices, $k + 2) * (pow(1 - $dificult / $sides, $dices - $k - 2)) * (pow($dificult / $sides, $k + 2));
                }
                $probabilidade += $p;
            }
        }
        return $probabilidade;
    }


    function binom($N, $k)
    {
        if ($k < 0 || $k > $N) {
            return 0;
        }
        $resultado = 1;
        for ($i = 1; $i <= $k; $i++) {
            $resultado *= ($N - $i + 1) / $i;
        }
        return $resultado;
    }

    public function calcular_probabilidade($P1, $P2, $Y, $X) {
        $p = $P1 + (1 - $P1) * $P2;
        $prob_acumulada = 0;
        for ($x = 0; $x <= $X; $x++) {
            $prob_x = 0;
            for ($k = $x; $k <= $Y; $k++) {
                $comb = $this->calcFact($Y, $k);
                $prob_x += $comb * pow($p, $k) * pow(1 - $p, $Y - $k);
            }
            $prob_acumulada = $this->calcFact($Y, $x) * pow($p, $x) * pow(1 - $p, $Y - $x);
            #$prob_acumulada += $prob_x;
        }
        $probabilidade = 1 - $prob_acumulada;
        return $probabilidade;
    }

    function calcular_probabilidade2($P1, $P2, $Y, $X) {
        $p = $P1 + (1 - $P1) * $P2;
        $prob_acumulada = 0;
        for ($x = 0; $x <= $X; $x++) {
            $comb = 0;
            for ($k = max(0, -$x); $k <= $Y - $x; $k++) {
                $comb_k = gmp_mul(gmp_mul(gmp_div(gmp_sub($Y, $k), gmp_add(1, -$x)), $k), gmp_pow(gmp_add(1, -$p), gmp_sub($Y, $k)));
                $comb = gmp_add($comb, $comb_k);
            }
            $comb_x = gmp_mul(gmp_mul(gmp_div(gmp_fact($Y), gmp_mul(gmp_fact($x), gmp_fact(gmp_sub($Y, $x)))), gmp_pow($p, $x)), gmp_pow(gmp_add(1, -$p), gmp_sub($Y, $x)));
            $prob_acumulada = gmp_add($prob_acumulada, $comb_x);
        }
        $probabilidade = gmp_strval(gmp_sub(1, $prob_acumulada));
        return $probabilidade;
    }

    public function calcFact(int $a, int $b):float {
        $fy  = gmp_fact($a);
        $fk  = gmp_fact($b);
        $fact = gmp_fact($a - $b);
        $dv = gmp_div($fy, gmp_mul($fk, $fact));
        return floatval(gmp_strval($dv));
    }

    public function fatorial($n)
    {
        $f = 1;
        for ($i = 1; $i <= $n; $i++) {
            $f *= $i;
        }
        return $f;
    }
    private $numSides = 10;
    private $successProbabilities = [
        6 => 0.2,
        7 => 0.2,
        8 => 0.2,
        9 => 0.2,
        10 => 0.1
    ];

    public function calculateProbability($numRolls, $minScore) {
        $maxScore = $this->numSides * $numRolls;
        if ($minScore >= $maxScore) {
            return 0;
        }

        $successProbabilities = $this->successProbabilities;
        $failureProbability = 1 - array_sum($successProbabilities);

        $cumulativeProbability = 0;
        for ($score = $minScore + 1; $score <= $maxScore; $score++) {
            $successCount = $score;
            $failureCount = $numRolls - $score;
            if ($failureCount < 0) {
                break;
            }

            $successProbability = 1;
            foreach ($successProbabilities as $scoreValue => $probability) {
                $successProbability *= pow($probability, ($score == $scoreValue ? $successCount : 0));
            }
            $failureProbability = pow($failureProbability, $failureCount);

            $binomialCoefficient = $this->calculateBinomialCoefficient($numRolls, $score);

            $cumulativeProbability += $successProbability * $failureProbability * $binomialCoefficient;
        }

        return $cumulativeProbability;
    }

//    private function calculateBinomialCoefficient($n, $k) {
//        if ($k < 0 || $k > $n) {
//            return 0;
//        }
//
//        $result = 1;
//        for ($i = 1; $i <= $k; $i++) {
//            $result *= ($n - $k + $i) / $i;
//        }
//
//        return $result;
//    }
    private function calculateBinomialCoefficient($n, $k) {
        $coefficient = 1;
        for ($i = 1; $i <= $k; $i++) {
            $coefficient *= ($n - $i + 1) / $i;
        }
        return $coefficient;
    }
}
