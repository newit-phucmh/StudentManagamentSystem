<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

   /**
    * Get the class that owns the Course
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function classObject()
   {
       return $this->belongsTo(ClassObject::class);
   }


}
