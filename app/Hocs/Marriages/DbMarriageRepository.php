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

    /**
     * Them moi cuoc hon nhan
     * @param  array $datas Mang du lieu
     * @return array        Mang user va cuoc hon nhan
     */
    public function store($datas)
    {
        $datas = $this->parserDatas($datas);

        $model = $this->model->create($datas['marriage']);
        $new_user = $this->helper->storeUser($datas['user']);

        $this->updateForeignKey($model, $new_user, $datas['user']);

        $model = $this->getById($model->id);

        return ['model' => $model, 'user' => $new_user];
    }

    /**
     * Xu ly du lieu truyen len tu ng dung
     * @param  array $datas Mang du lieu truoc khi xu ly
     * @return array        Mang du lieu sau khi xu ly
     */
    public function parserDatas($datas)
    {
        $user_data = array_get($datas, 'user', []);
        $marriage_data = array_get($datas, 'marriage', []);

        $is_ended = array_get($marriage_data, 'is_ended', false);
        $ended_at = array_get($marriage_data, 'ended_at', null);
        $marriage_data['ended_at'] = $is_ended ? $ended_at : null;

        return ['user' => $user_data, 'marriage' => $marriage_data];
    }

    /**
     * Cap nhat id khoa ngoai
     * @param  Marriage $model    Doi tuong hon nhan
     * @param  User $new_user     Doi tuong User (vo / chong)
     * @param  array $data        Mang du lieu
     * @return void
     */
    public function updateForeignKey($model, $new_user, $data)
    {
        $user_id = array_get($data, 'current_id', null);
        $current_user = $this->helper->getUserById($user_id);

        $model->husband_id = $current_user->isMan() ? $current_user->id : $new_user->id;
        $model->wife_id    = !$current_user->isMan() ? $current_user->id : $new_user->id;

        $model->save();
    }
}
