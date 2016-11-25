<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'topic_id'];

    public function user()
    {
        return $this->belongsTo('\App\DataAccess\Eloquent\User');
    }
        
    public function topic()
    {
        return $this->belongsTo('\App\DataAccess\Eloquent\Topic');
    }
}
