<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['id', 'candidat_id', 'job_vacancy_id'];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function job_vacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }
}
