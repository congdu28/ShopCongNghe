<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'coupon';
    protected $fillable = ['coupon_id', 'coupon_name', 'coupon_code', 'coupon_time', 'coupon_condition','coupon_number'];
    
    protected $primaryKey = 'coupon_id';

}
