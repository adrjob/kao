<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    public function document()
    {
        return $this->belongsTo(Documents::class, 'doc_id', 'id');
    }
}
