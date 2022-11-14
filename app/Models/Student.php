<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jurusan',
    ];
    protected $guarded = 
    [
        'nama',
        'nim',
        'email',
        'jurusan',
    ];
}
