<?php

namespace App\Http\Controllers;


use App\Services\CalculatorService;
use App\Services\CalculationsService;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    protected $calculatorService;
    protected $calculationsService;

    public function __construct(CalculatorService $calculatorService, CalculationsService $calculationsService)
    {
        $this->calculatorService = $calculatorService;
        $this->calculationsService = $calculationsService;
    }

    /**
     *
     * Entry point for Calculate api endpoint
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(Request $request)
    {
        try {
            //remove spaces form equation so we can work with something consitent.
            $equation = str_replace(' ', '', ($request->get('equation')));

            if (!$parsedEq = $this->calculatorService->parseEquation($equation)) {
                return response()->json([
                    'success' => false,
                    'data' => ['error' => 'Could not parse equation please try again', 'equation' => $equation]
                ],400);
            }

            $results = $this->calculatorService->calcResults($parsedEq);
            if ($results === false) {
                return response()->json([
                    'success' => false,
                    'data' => ['error' => 'Calculation failed', 'equation' => $equation]
                ],500);
            }

            $calculation = "$equation=$results"; //put the equation together with results
            $calculations = $this->calculationsService->updateCalculations($calculation);

            return response()->json([
                'success' => true,
                'data' => ['results'=> $calculation, 'calculations' => $calculations, 'equation' => $equation ],
            ],200);

        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'data' => ['error' => $exception->getMessage(), 'equation' => $equation]
            ],500);
        }
    }

    /**
     *
     * Entry point for get Calculations api call.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCalculations(){
        try {
            $calculations = $this->calculationsService->getCalculations();

            return response()->json([
                'success' => true,
                'data' => ['calculations' => $calculations],

            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'success' => true,
                'data' => ['Error'=>$exception->getMessage()],
            ], 500);
        }
    }
}
