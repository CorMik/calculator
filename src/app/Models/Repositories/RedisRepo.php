<?php

namespace App\Models\Repositories;

use Illuminate\Support\Facades\Redis;

class RedisRepo
{

    /**
     * @param $equation
     */
    public function setFromKey($key,$value){
        return Redis::set($key,$value);
    }

    public function getFromKey($key){
        return Redis::get($key);
    }

}
