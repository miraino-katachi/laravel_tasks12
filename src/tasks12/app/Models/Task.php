<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /** @var array 値を代入しないプロパティ */
    protected $guarded = [
        'id',
        'user_id',
    ];

    /** @var array 値をキャストするカラム */
    protected $casts = [
        'registration_date' => 'date',
        'expiration_date' => 'date',
        'completion_date' => 'date',
    ];
}
