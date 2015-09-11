<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'price', 'id_category'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function category()
    {
        return $this->belongsTo('App\Category','id_category');
    }

    public function products_colors()
    {
        return $this->hasMany('App\ProductColor','id_product');
    }

    public function getColorsNamesAttribute()
    {
        $retorno = "";
        $coma = "";

        //dd("hola");

        foreach($this->products_colors as $colors)
        {
            $retorno .= $coma.$colors->color->name;
            $coma = ", ";
        }

        return $retorno;
    }

    public function getCategoryNameAttribute()
    {
        if($this->category != null)
            return $this->category->name;

    }

}