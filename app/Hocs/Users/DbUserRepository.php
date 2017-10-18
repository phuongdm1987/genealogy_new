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
        $is_dead = array_get($data, 'is_dead', false);
        $dod = array_get($data, 'dod', null);
        $data['dod'] = $is_dead ? $dod : null;

        $data['password'] = bcrypt(array_get($data, 'password', null));
        $data['confirmation_code'] = str_random(8) . "-" . base64_encode($data['email']);

        $model = $this->model->create($data);

        $model->hashid = \Hashids::encode($model->id);
        $model->save();

        $avatar = array_get($data, 'avatar', null);
        $width  = array_get($data, 'avatar_width', 0);
        $height = array_get($data, 'avatar_height', 0);
        $x      = array_get($data, 'avatar_x', 0);
        $y      = array_get($data, 'avatar_y', 0);

        $this->uploadAvatar($avatar, $width, $height, $x, $y, $model);

        return $this->getById($model->id);
    }

    /**
     * Them moi Vo / chong
     * @param  array $data Mang du lieu
     * @return User        Vo / chong
     */
    public function storeCouple($data)
    {
        $user_current = auth()->user();
        $data['sex'] = $user_current->isMan() ? false : true;
        // $data['parent_id'] = $user_current->parent_id;

        return $this->store($data);
    }

    /**
     * Them moi Anh / chi / em
     * @param  array $data Mang du lieu
     * @return User        Anh / chi / em
     */
    public function storeSibling($data)
    {
        $user_current = auth()->user();
        $data['parent_id'] = $user_current->parent_id;
        return $this->store($data);
    }

    /**
     * Them moi Con cai
     * @param  array $data Mang du lieu
     * @return User        Con cai
     */
    public function storeChild($data)
    {
        $user_current = auth()->user();
        $data['parent_id'] = $user_current->id;
        return $this->store($data);
    }

    /**
     * Tra ve danh sach user da cap
     * @param  User     $current_user   Doi tuong user hien tai
     * @return string                   Html menu danh sach user
     */
    public function getToTree($current_user = null)
    {
        if (!auth()->user()) {
            return null;
        }

        $nodes = $this->model->get()->toTree();

        $this->getRecursive($nodes, $html, $current_user);

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
    public function getRecursive($users, &$html, $current_user = null)
    {
        $current_user = is_null($current_user) ? auth()->user() : $current_user;

        foreach ($users as $user) {
            $active = $current_user->id == $user->id ? " class='is-active'" : '';
            $html .= "<li{$active}><a href='"
                . route('users.show', ['user' => $user->hashid])
                . "'><i class='fi-list'></i> <span>{$user->name}</span></a>";

            $html .= !$user->children->isEmpty() ? '<ul class="menu vertical nested">' : '';
            $this->getRecursive($user->children, $html, $current_user);
            $html .= !$user->children->isEmpty() ? '</ul>' : '';

            $html .= '</li>';
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
        $model->marriages->delete();
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
        $model->fill($data)->save();

        $avatar = array_get($data, 'avatar', null);
        $width  = array_get($data, 'avatar_width', 0);
        $height = array_get($data, 'avatar_height', 0);
        $x      = array_get($data, 'avatar_x', 0);
        $y      = array_get($data, 'avatar_y', 0);
        $this->uploadAvatar($avatar, $width, $height, $x, $y, $model);

        return $this->getById($model->id, 'withoutScope');
    }

    /**
     * Tai anh dai dien
     * @param  FileUpload $file File anh tai len
     * @param  User $user Doi tuong user
     * @return User       Doi tuong user
     */
    public function uploadAvatar($file, $width, $height, $x = null, $y = null, $user = null)
    {
        if (!$file) {
            return $user;
        }

        $width = (int) $width;
        $height = (int) $height;
        $x = $x ? (int) $x : null;
        $y = $y ? (int) $y : null;

        $filename = time() . '.' . $file->getClientOriginalExtension();
        \Image::make($file)
            ->crop($width, $height, $x, $y)
            ->resize(300, 300)
            ->save(storage_path('app/public/uploads/avatars/' . $filename));

        $user = is_null($user) ? auth()->user() : $user;
        $user->avatar = $filename;
        $user->save();

        return $user;
    }
}
