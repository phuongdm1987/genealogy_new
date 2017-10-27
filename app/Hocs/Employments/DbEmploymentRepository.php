<?php

namespace Genealogy\Hocs\Employments;

use Genealogy\Hocs\BaseRepository;
use Genealogy\Hocs\Helpers\EmploymentHelper;

class DbEmploymentRepository extends BaseRepository implements EmploymentRepository
{
    /**
     * Constructor
     * @param Employment $employment
     */
    public function __construct(Employment $employment, EmploymentHelper $helper)
    {
        $this->model  = $employment;
        $this->helper = $helper;
    }

    /**
     * Them moi cuoc hon nhan
     * @param  array $datas Mang du lieu
     * @return array        Mang user va cuoc hon nhan
     */
    public function store($datas)
    {
        $datas = $this->parserDatas($datas);
        $model = $this->model->create($datas);
        $model = $this->getById($model->id);

        return $model;
    }

    public function update($model, $datas)
    {
        $datas['current_id'] = $model->user_id;
        $datas = $this->parserDatas($datas);
        $model->fill($datas)->save();
        return $this->getById($model->id, 'withoutScope');
    }

    /**
     * Xu ly du lieu truyen len tu ng dung
     * @param  array $datas Mang du lieu truoc khi xu ly
     * @return array        Mang du lieu sau khi xu ly
     */
    public function parserDatas($datas)
    {
        $current_id = array_get($datas, 'current_id', null);
        $is_current = array_get($datas, 'is_current', false);
        $ended_at = array_get($datas, 'ended_at', null);

        $current_user = $this->helper->getUserById($current_id);

        $datas['ended_at'] = $is_current ? null : $ended_at;
        $datas['user_id'] = $current_user->id;

        return $datas;
    }
}
