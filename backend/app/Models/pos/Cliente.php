<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
	use Notifiable;
    public $timestamps = true;
    use SoftDeletes;
	
    protected $fillable = [
        'nombre', 'documento',
    ];
	protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at','deleted_at'];
	
    public static $rules = [
        'nombre' => 'required|string',
        'documento' => 'required|string',
    ];
	
	public function scopeNombre($query, $name){
		if($name)
			return $query->where('nombre', 'like', "%$name%");
	}
	public function scopeDocumento($query, $documento){
		if($documento)
			return $query->where('documento', 'like', "%$documento%");
	}	
	public function scopeEmail($query, $email){
		if($email)
			return $query->where('email', 'like', "%$email%");
	}	
	
}
