<?php

namespace Genealogy\Hocs\Employments;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
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
        'user_id', 'company', 'position', 'description', 'is_current', 'started_at', 'eneded_at'
    ];

    public function getPosition()
    {
        return $this->position ? $this->position : 'N/a';
    }

    public function getStartedAt($format = 'd-m-Y H:i:s', $type = 'show')
    {
        if (!$this->started_at && $type == 'edit') {
            return $this->started_at;
        }

        return $this->started_at ? $this->started_at->format($format) : 'N/a';
    }

    public function getEndedAt($format = 'd-m-Y H:i:s', $type = 'show')
    {
        if (!$this->eneded_at && $type == 'edit') {
            return $this->eneded_at;
        }

        if ($this->is_current) {
            return 'Công việc hiện tại';
        }

        return $this->eneded_at ? $this->eneded_at->format($format) : 'N/a';
    }

    public function user()
    {
        return $this->belongsTo('Genealogy\Hocs\Users\User', 'user_id');
    }
}
