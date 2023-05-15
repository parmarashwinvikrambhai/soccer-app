<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    /**
     * we just define the table name
     */
    protected $table = 'teams';
    /**
     * define which field can used in table
     */
    protected $guarded = [];
    // protected $fillable =[
    //     'id',
    //     'name',
    //     'logo'
    // ];

    // public function players()
    // {
    //     return $this->hasMany(Player::class,'teams_id','id');
    // }
}
