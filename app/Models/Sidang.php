<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id', 'id');
    }

    public function paa()
    {
        return $this->belongsTo(User::class, 'paa_id', 'id');
    }

    public function pengaju()
    {
        return $this->belongsTo(User::class, 'pengaju_id', 'id');
    }
}
