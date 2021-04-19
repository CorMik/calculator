<?php

namespace App\Models\Repositories;

use Illuminate\Support\Facades\Redis;

class RedisRepo
{

    /**
     *
     * Set Redis entry from key
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setFromKey($key,$value){
        return Redis::set($key,$value);
    }

    /**
     *
     * Get redis entry from key
     *
     * @param $key
     * @return mixed
     */
    public function getFromKey($key){
        return Redis::get($key);
    }

}
