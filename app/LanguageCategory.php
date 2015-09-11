<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageCategory extends Model
{
    //
    protected $table = 'languages_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_language','id_category','name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

}
