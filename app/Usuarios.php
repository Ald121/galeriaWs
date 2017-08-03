<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Usuarios extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $primaryKey = 'id';
     public $timestamps = false;
     public $incrementing = false;
    protected $fillable = [
        'id', 'nick', 'pass','userType'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'pass',
    ];
    public function getAuthPassword() {
    return $this->pass;
    }
    
}
