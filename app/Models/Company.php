<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['user_id', 'id'];

    public function job_vacancy()
    {
        return $this->hasMany(JobVacancy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
