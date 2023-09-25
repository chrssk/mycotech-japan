<?php

namespace App\Models\Baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedBaglog extends Model
{
    use HasFactory;
    protected $table = 'used_baglog';

    protected $fillable = [
        'MyleaID',
        'BaglogID',
        'Total',  
    ];
}
