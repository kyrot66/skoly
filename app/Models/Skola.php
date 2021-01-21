<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skola extends Model
{
    use HasFactory;

    protected $table = 'skola';
    public $timestamps = true;

    protected $guarded = [];

    public function mesto() {
        return $this->hasOne('App\Models\Mesto', 'id', 'mesto');
    }
}
