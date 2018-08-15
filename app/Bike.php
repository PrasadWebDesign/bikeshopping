<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    	}
    }

}
