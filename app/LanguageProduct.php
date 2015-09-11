<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageProduct extends Model
{
    //
    protected $table = 'languages_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_language','id_product','name','description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
