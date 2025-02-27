<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = ['id','created_at','updated_at'];

}
