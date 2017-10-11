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
    public function storeSbling($data)
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
     * @param string $value [description]
     */
    public function getToTree()
    {
        $nodes = $this->model->get()->toTree();

        $this->getRecursive($nodes, $html);

        return $html;
    }

    /**
     * lay de quy ra tat ca user
     * @param  collection  $users       Danh sach user
     * @param  string      &$html       Bien luu html
     * @param  boolean     $is_children Check xem co phai node con ko
     * @return string                   Html
     */
    public function getRecursive($users, &$html)
    {
        foreach ($users as $user) {
            $html .= '<li><a href="#">' . $user->name . '</a>';

            $html .= !$user->children->isEmpty() ? '<ul class="menu vertical nested">' : '';
            $this->getRecursive($user->children, $html);
            $html .= !$user->children->isEmpty() ? '</ul>' : '';

            $html .= '</li>';
        }

        return $html;
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
