<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaProduction extends Model
{
    use HasFactory;
    protected $table = 'mylea_production';

    protected $fillable = [
        'MyleaCode',
        'ProductionDate',
        'TotalTray',
    ];
}
