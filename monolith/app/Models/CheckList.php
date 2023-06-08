<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    /**
     * Returns the owner of this list
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the items of this list
     */
    public function items()
    {
        return $this->hasMany(CheckListItem::class);
    }
}
