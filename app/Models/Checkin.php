<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassObject;
use App\Models\Course;

class Checkin extends Model
{
    use HasFactory;

    /**
     * Get all of the course for the Checkin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Get all of the classes for the Checkin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->hasMany(ClassObject::class);
    }

}
