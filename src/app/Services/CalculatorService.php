<?php


namespace App\Services;


class CalculatorService
{
    /**
     * Calculate results based on operator
     *
     * @param $parsedEq
     * @return false|float|int|mixed
     */
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

    /**
     *
     * parse equation using regex
     *
     * @param $equation
     * @return array|false
     */
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

    /**
     *
     * locate operator in string and break down equation.
     *
     * @param $equation
     * @return false|mixed
     */
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
