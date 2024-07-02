<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $guarded = ["id"];

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'jobTitleID');
    }

    public function department()
    {
        return $this->hasOneThrough(Department::class, JobTitle::class, 'id', 'id', 'jobTitleID', 'departmentID');
    }
}

