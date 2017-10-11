<?php

namespace Genealogy\Hocs\Marriages;

use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['started_at', 'ended_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'husband_id', 'wife_id', 'started_at', 'eneded_at'
    ];

    /**
     * Tra ve doi tuong nguoi chong
     * @return [type] [description]
     */
    public function husband()
    {
        return $this->belongsTo('Genealogy\Hocs\Users\User', 'husband_id');
    }

    /**
     * Tra ve doi tuong nguoi vo
     * @return [type] [description]
     */
    public function wife()
    {
        return $this->belongsTo('Genealogy\Hocs\Users\User', 'wife_id');
    }
}
