<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuloLink extends Model
{
	use Notifiable;

    protected $table = 'modulolinks';
    public $timestamps = true;

    use SoftDeletes;
	
    protected $fillable = [
        'modulo', 'page', 'url'
    ];	

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
    public static $directionOrder = ['ASC','ASC'];

    public static $rules = [
        'modulo' => 'required',
        'page' => 'required|string|max:50',
        'url' => 'required|string|max:30',
    ];
}
