<?php

namespace App\Models;

use App\Traits\Creatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use Creatable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'student_number', 
        'first_name', 
        'surname', 
        'created_by'
    ];

    /**
     * An accessor which returns both the first name and surname 
     * of a student in a single string.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->surname;
    }

    /**
     * All the grades for a student.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
