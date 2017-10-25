<?php

namespace Genealogy\Hocs\Users;

use Genealogy\Hocs\BaseRepository;

class DbUserRepository extends BaseRepository implements UserRepository
{
    /**
     * Constructor
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getByConfirmCode($token)
    {
        return $this->model->where('confirmation_code', $token)->first();
    }

    public function store($data)
    {
        $data = $this->parserDatas($data);
        $model = $this->model->create($data);

        $this->updateHashId($model);

        $this->uploadAvatar($data, $model);

        return $this->getById($model->id);
    }

    public function parserDatas($datas)
    {
        $is_dead = array_get($datas, 'is_dead', false);
        $dod = array_get($datas, 'dod', null);
        $datas['dod'] = $is_dead ? $dod : null;

        $datas['password'] = bcrypt(array_get($datas, 'password', null));
        $datas['confirmation_code'] = str_random(8) . "-" . base64_encode($datas['email']);

        return $datas;
    }

    public function updateHashId($model)
    {
        $model->hashid = \Hashids::encode($model->id);
        $model->save();
    }

    /**
     * Them moi Vo / chong
     * @param  array $data Mang du lieu
     * @return User        Vo / chong
     */
    public function storeCouple($data)
    {
        $current_id = array_get($data, 'current_id', null);
        $current_user = $this->getById($current_id);

        $data['parent_id'] = $current_user->parent_id;
        $data['sex'] = $current_user->isMan() ? false : true;

        return $this->store($data);
    }

    /**
     * Them moi Anh / chi / em
     * @param  array $data Mang du lieu
     * @return User        Anh / chi / em
     */
    public function storeSibling($data)
    {
        return $this->store($data);
    }

    /**
     * Them moi Con cai
     * @param  array $data Mang du lieu
     * @return User        Con cai
     */
    public function storeChild($data)
    {
        return $this->store($data);
    }

    /**
     * Tra ve danh sach user da cap
     * @param  User     $current_user   Doi tuong user hien tai
     * @return string                   Html menu danh sach user
     */
    public function getToTree($current_user = null, $type = 'html')
    {
        if (!auth()->user()) {
            return null;
        }

        $method_name = "getRecursive" . ucfirst($type);

        $nodes = $this->model->get()->toTree();

        $this->{$method_name}($nodes, $html, $current_user);

        return $html;
    }

    /**
     * lay de quy ra tat ca user
     * @param  collection  $users           Danh sach user
     * @param  string      &$html           Bien luu html
     * @param  boolean     $is_children     Check xem co phai node con ko
     * @param  User        $current_user    Doi tuong user hien tai
     * @return string                       Html
     */
    public function getRecursiveHtml($users, &$html, $current_user = null)
    {
        $current_user = is_null($current_user) ? auth()->user() : $current_user;

        foreach ($users as $user) {
            $active = $current_user->id == $user->id ? " class='is-active'" : '';
            $html .= "<li{$active}><a href='"
                    . route('users.show', ['user' => $user->hashid])
                    . "'><i class='fi-list'></i> <span>{$user->name}</span></a>";

            $html .= !$user->children->isEmpty() ? '<ul class="menu vertical nested">' : '';
            $this->getRecursiveHtml($user->children, $html, $current_user);
            $html .= !$user->children->isEmpty() ? '</ul>' : '';

            $html .= '</li>';
        }

        return $html;
    }

    public function getRecursiveList($users, &$html, $current_user = null, $prefix = '-')
    {
        $current_user = is_null($current_user) ? auth()->user() : $current_user;

        foreach ($users as $user) {
            $selected = $current_user->id == $user->id ? "selected" : '';
            $html .= "<option value='{$user->id}' {$selected}>{$prefix} {$user->name}</option>";

            $this->getRecursiveList($user->children, $html, $current_user, $prefix . '-');
        }

        return $html;
    }

    /**
     * Xóa 1 bản ghi. Nếu model xác định 1 SoftDeletes
     * thì method này chỉ đưa bản ghi vào trash. Dùng method destroy
     * để xóa hoàn toàn bản ghi.
     *
     * @param  object $model Bản ghi hien tai
     * @return bool|null
     */
    public function delete($model)
    {
        $model->marriages()->delete();
        return $model->delete();
    }

    /**
     * Cập nhật thông tin 1 bản ghi theo ID
     *
     * @param  object $model Bản ghi hien tai
     * @return bool
     */
    public function update($model, $data)
    {
        $data = array_only($data, [
            'name', 'phone', 'dob', 'avatar', 'avatar_width', 'avatar_height',
            'avatar_x', 'avatar_y', 'parent_id'
        ]);
        $model->fill($data)->save();

        $this->uploadAvatar($data, $model);

        return $this->getById($model->id, 'withoutScope');
    }

    /**
     * Tai anh dai dien
     * @param  FileUpload $file File anh tai len
     * @param  User $user Doi tuong user
     * @return User       Doi tuong user
     */
    public function uploadAvatar($data, $user = null)
    {
        $avatar = array_get($data, 'avatar', null);
        $width  = array_get($data, 'avatar_width', 0);
        $height = array_get($data, 'avatar_height', 0);
        $x      = array_get($data, 'avatar_x', 0);
        $y      = array_get($data, 'avatar_y', 0);

        if (!$avatar) {
            return $user;
        }

        $width = (int) $width;
        $height = (int) $height;
        $x = $x ? (int) $x : null;
        $y = $y ? (int) $y : null;

        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        \Image::make($avatar)
            ->crop($width, $height, $x, $y)
            ->resize(300, 300)
            ->save(storage_path('app/public/uploads/avatars/' . $filename));

        $this->updateAvatar($filename, $user);

        return $filename;
    }

    public function updateAvatar($filename, $user)
    {
        $user = is_null($user) ? auth()->user() : $user;
        $user->avatar = $filename;
        $user->save();

        return $user;
    }
}
