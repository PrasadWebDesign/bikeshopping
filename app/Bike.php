<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;

class Bike extends Model
{
    public static function sort_by_bikes($sort_type) {
    	if('rate-asc-rank' == $sort_type) {
    		$sql =  DB::table('bikes')
    			->select('*')
    			->orderBy('hourly_rate')
    			->paginate(4);

    		return $sql;

    	} else if('rate-desc-rank' == $sort_type) {
    		$sql = DB::table('bikes')
    			->select('*')
    			->orderBy('hourly_rate', 'desc')
    			->paginate(4);

    		return $sql;

    	} else if('id-desc-rank' == $sort_type) {
            $sql = DB::table('bikes')
                ->select('*')
                ->orderBy('id', 'desc')
                ->paginate(4);

            return $sql;

        } else if('id-asc-rank' == $sort_type) {
            $sql = DB::table('bikes')
                ->select('*')
                ->orderBy('id')
                ->paginate(4);

            return $sql;
        } 


    }

    public static function sort_by_price($min_price, $max_price) {
        $sql = DB::select(' SELECT * FROM bikes WHERE hourly_rate >= '. $min_price .' AND hourly_rate<= '. $max_price .' ORDER BY hourly_rate');        

        return $sql; 
    }

}
