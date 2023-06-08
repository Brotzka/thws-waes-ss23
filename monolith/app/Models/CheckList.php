<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    use HasFactory;

    /**
     * Returns the owner of this list
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
