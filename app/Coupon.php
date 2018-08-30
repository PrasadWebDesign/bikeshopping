<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function FunctionName($code)
    {
    	return self::where('code',$code)->first();
    }

    public function discount($total)
    {
    	if ($this->type == 'fixed') {
    		return $this->fixed_amount_off;
    	} else if($this->type == 'percent_off') {
    		return round(($this->percent_off/100)*$total);
    	} else {
    		return 0;
    	}
    	
    }
}
