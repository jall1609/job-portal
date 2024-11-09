<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['user_id', 'id'];

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
