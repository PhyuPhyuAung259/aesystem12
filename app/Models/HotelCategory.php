<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    protected $table = 'hotel_category';    

    public function supplier (){
        return $this->belongsToMany(Supplier::class);//->withPivot($hotelRate);
    }
}
 