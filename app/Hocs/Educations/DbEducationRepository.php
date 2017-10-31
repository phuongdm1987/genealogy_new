<?php

namespace Genealogy\Hocs\Educations;

use Genealogy\Hocs\BaseRepository;
use Genealogy\Hocs\Helpers\EducationHelper;

class DbEducationRepository extends BaseRepository implements EducationRepository
{
    /**
     * Constructor
     * @param Education $education
     */
    public function __construct(Education $education, EducationHelper $helper)
    {
        $this->model  = $education;
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
        $datas['user_id'] = $current_id;

        $is_current = array_get($datas, 'is_current', false);
        $ended_at = array_get($datas, 'ended_at', null);

        $datas['ended_at'] = $is_current ? null : $ended_at;

        return $datas;
    }
}
