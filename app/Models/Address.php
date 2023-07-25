<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip_code',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
