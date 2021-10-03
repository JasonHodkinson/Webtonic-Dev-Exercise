<?php

namespace App\Models;

use App\Traits\Creatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use Creatable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code', 
        'description', 
        'created_by'
    ];

    /**
     * All the grades for a course.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
