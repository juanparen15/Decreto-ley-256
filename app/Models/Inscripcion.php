<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Inscripcion extends Model
{
    use HasFactory;
    protected $table = 'inscripcion';

    public function scopeCurrentUser($query)
    {
        if (Auth::user()->role_id == 2) {
            // $this->documento_tercero = Auth::user()->username;
            return $query->where('email', Auth::user()->email);
        } else {
            // Si el usuario no está autenticado o su role_id no es igual a 2, retornamos una consulta vacía
            // return $query->where('id', '=', null);
        }
    }

    protected static function boot()
    {
        parent::boot();

        // Utiliza el evento creating para establecer el campo documento_tercero
        static::creating(function ($inscripcion) {
            // Verifica si hay un usuario autenticado
            if (Auth::check()) {
                // Establece el valor del campo documento_tercero como el nombre de usuario del usuario autenticado
                $inscripcion->resultado = 0;
            }
        });
    }
}
