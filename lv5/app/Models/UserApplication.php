<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'nastavnik_id'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
