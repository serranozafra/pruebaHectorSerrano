<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageColor extends Model
{
    //
    protected $table = 'languages_colors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_language','id_color','name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

}
