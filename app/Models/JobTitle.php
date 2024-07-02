<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;
    protected $table = "job_titles";
    protected $guarded = ["id"];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentID');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'jobTitleID');
    }
}


