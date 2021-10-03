<?php 

namespace App\Traits;

trait Creatable 
{
    /**
     * The user that created the resource.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}