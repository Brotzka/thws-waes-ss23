<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckListItem extends Model
{
    use HasFactory;

    /**
     * Returns the list this item belongs to
     */
    public function checkList()
    {
        return $this->belongsTo(CheckList::class);
    }
}
