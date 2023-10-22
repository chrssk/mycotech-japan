<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishGood extends Model
{
    use HasFactory;
    protected $table = 'finish_good';

    protected $fillable = [
        'HarvestID',
        'FinishGoodCode',  
        'FinishGoodDate',  
        'Total', 
    ];


    public function harvest()
    {
        return $this->belongsTo(MyleaHarvest::class);
    }
}
