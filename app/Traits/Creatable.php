<?php 

namespace App\Traits;

trait Creatable 
{
    /**
     * Make sure the "creating" event is overridden to 
     * include the user ID of the creator if possible.
     *
     * @return void
     */
    public static function bootCreatable()
    {
        if (auth()->check()) {
            static::creating(function ($model) {
                $model->created_by = auth()->id();
            });
        }
    }

    /**
     * The user that created the resource.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}