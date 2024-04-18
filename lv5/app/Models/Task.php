<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'naziv_rada',
        'naziv_rada_en',  
        'zadatak_rada',
        'tip_studija',
        'nastavnik_id',
        'assignee'
    ];

    public function applications()
    {
        return $this->hasMany(UserApplication::class, 'task_id', 'id');
    }

    public function nastavnik()
    {
        return $this->belongsTo(User::class, 'nastavnik_id');
    }
}
