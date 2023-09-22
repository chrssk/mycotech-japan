<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baglog extends Model
{
    use HasFactory;

    protected $table = 'baglog';

    protected $fillable = [
        'BaglogCode',
        'ArrivalDate',
        'Quantity',   
        'Notes', 
    ];

}
