<?php


namespace App\Services;


class CalculatorService
{
    /**
     * CalculatorService constructor.
     */
    public function __construct()
    {

    }

    public function calcResults($parsedEq){

        switch ($parsedEq['operator']){
            case "+":
                return $parsedEq['number'][0] + $parsedEq['number'][1];
            case "-":
                return $parsedEq['number'][0] - $parsedEq['number'][1];
            case "/":
                return $parsedEq['number'][0] / $parsedEq['number'][1];
            case "*":
                return $parsedEq['number'][0] * $parsedEq['number'][1];
        }

        return false;
    }

    public function parseEquation($equation){

        $pattern = '/^[0-9]+[\.]?[0-9]*[-+*\/]{1}[0-9]+[\.]?[0-9]*$/';
        if(!preg_match($pattern,$equation)){
            return false;
        }

        if(!$operator = $this->findOperator($equation)){
            return false;
        }
        $eqArray = explode($operator,$equation);
        return ['number' => $eqArray, 'operator' => $operator];


    }

    private function findOperator($equation){

        $matches = [];
        $pattern = '/[-+*\/]/';
        preg_match($pattern,$equation,$matches);
        if(empty($matches)){
            return false;
        }

        return $matches[0];
    }

}
