<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $table = 'data_dep';

    protected $fillable = [
        'date',
        'maille_code',
        'deces',
        'reanimation',
        'hospitalises',
        'nouvelles_hospitalisations',
        'gueris',
        'nouvelles_reanimations',
        
    ];

}


$var = 'testhhhh';

?>