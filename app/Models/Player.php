<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    /**
     * we just define the table name
     */
    protected $table = 'players';
    /**
     * define which field can used in table
     */
    protected $guarded = [];
    // protected $fillable =[
    //     'first_name',
    //     'last_name',
    //     'photo',
    //     'team_id'

    // ];
    // public function teams()
    // {
    //     return $this->belongsTo('Teams::class');
    // }
}
