<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaHarvest extends Model
{
    use HasFactory;
    protected $table = 'mylea_harvest';

    protected $fillable = [
        'MyleaID',
        'BaglogID',
        'HarvestDate',   
        'Total', 
        'Notes', 
    ];
}
