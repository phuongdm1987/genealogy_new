<?php

namespace Genealogy\Hocs\Educations;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

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
        'user_id', 'school', 'subject', 'degree', 'description', 'started_at', 'ended_at'
    ];

    public function getSubject()
    {
        return $this->subject ? $this->subject : 'N/a';
    }

    public function getDegree()
    {
        return $this->degree ? $this->degree : 'N/a';
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
        if (!$this->ended_at && $type == 'edit') {
            return $this->ended_at;
        }

        return $this->ended_at ? $this->ended_at->format($format) : 'N/a';
    }

    public function user()
    {
        return $this->belongsTo('Genealogy\Hocs\Users\User', 'user_id');
    }
}
