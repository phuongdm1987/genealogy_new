<?php

namespace Genealogy\Hocs\Marriages;

use Genealogy\Hocs\BaseRepository;
use Genealogy\Hocs\Helpers\MarriageHelper;

class DbMarriageRepository extends BaseRepository implements MarriageRepository
{
    /**
     * Constructor
     * @param Marriage $marriage
     */
    public function __construct(Marriage $marriage, MarriageHelper $helper)
    {
        $this->model  = $marriage;
        $this->helper = $helper;
    }

    public function store($datas)
    {
        $user_data = array_get($datas, 'user', []);
        $marriage_data = array_get($datas, 'marriage', []);

        $is_ended = array_get($marriage_data, 'is_ended', false);
        $ended_at = array_get($marriage_data, 'ended_at', null);

        $user_current = auth()->user();

        $marriage_data['ended_at'] = $is_ended ? $ended_at : null;

        $model = $this->model->create($marriage_data);
        $user  = $this->helper->storeUser($user_data);

        $model->husband_id = $user_current->isMan() ? $user_current->id : $user->id;
        $model->wife_id    = !$user_current->isMan() ? $user_current->id : $user->id;
        $model->save();

        return $user;
    }
}
