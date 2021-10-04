<?php

namespace App\Models;

use App\Traits\Creatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use Creatable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'course_id', 
        'student_id', 
        'letter', 
        'created_by'
    ];

    /**
     * Get an array of valid letters to score students on.
     * 
     * @return string[]
     */
    public static function availableLetters()
    {
        return ['A', 'B', 'C', 'D', 'E', 'F'];
    }

    /**
     * A mutator which will convert the grade letter to uppercase before saving.
     *
     * @param  string  $value
     * @return void
     */
    public function setLetterAttribute($value)
    {
        $this->attributes['letter'] = strtoupper($value);
    }

    /**
     * An accessor which will get the color dependant on the grade letter.
     * 
     * @return string
     */
    public function getColorAttribute()
    {
        if ($this->letter == "A") {
            return "green";
        }

        if ($this->letter == "F") {
            return "red";
        }

        return "yellow";
    }

    /**
     * The course the grade is for.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * The student the grade is for.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
