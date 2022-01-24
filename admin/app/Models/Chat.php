<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id','tva');
    }
}
