<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    protected $table = 'products_colors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_product','id_color'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function color()
    {
        return $this->belongsTo('App\Color','id_color');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','id_product');
    }

}
