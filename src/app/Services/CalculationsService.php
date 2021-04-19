<?php


namespace App\Services;


use App\Models\Repositories\RedisRepo;

class CalculationsService
{

    /**
     * @var RedisRepo
     */
    protected $redisRepo;

    /**
     * CalculationsService constructor.
     * @param RedisRepo $redisRepo
     */
    public function __construct(RedisRepo $redisRepo)
    {
        $this->redisRepo = $redisRepo;
    }

    /**
     * Get calculations from redis
     *
     * @return mixed
     */
    public function getCalculations(){
        return json_decode($this->redisRepo->getFromKey('calculations'));
    }

    /**
     * update calculations in redis when we have a new one
     * @param $newCalculation
     * @return array|mixed
     */
    public function updateCalculations($newCalculation){

        $calculations = $this->getCalculations();

        if(is_null($calculations)){
            $calculations = [];
        }

        if(count($calculations) > 9){
            array_pop($calculations);
        }

        array_unshift($calculations,$newCalculation);
        $this->redisRepo->setFromKey('calculations',json_encode($calculations));

        return $calculations;
    }

}
