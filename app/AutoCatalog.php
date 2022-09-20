<?php

namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoCatalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mark',
        'model',
        'generation',
        'run',
        'color',
        'body_type',
        'engine_type',
        'transmission',
        'gear_type',
        'generation_id'

        ];

    public $timestamps = false;
}
