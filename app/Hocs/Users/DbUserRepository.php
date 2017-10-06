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
        $data['password'] = bcrypt(array_get($data, 'password', null));
        $data['confirmation_code'] = str_random(8) . "-" . base64_encode($data['email']);

        $model = $this->model->create($data);

        $avatar = array_get($data, 'avatar', null);
        $this->uploadAvatar($avatar, $model);

        return $this->getById($model->id);
    }

    /**
     * Tai anh dai dien
     * @param  FileUpload $file File anh tai len
     * @param  User $user Doi tuong user
     * @return User       Doi tuong user
     */
    public function uploadAvatar($file, $user = null)
    {
        if (!$file) {
            return $user;
        }

        $filename = time() . '.' . $file->getClientOriginalExtension();
        \Image::make($file)->resize(150, 150)->save( storage_path('app/public/uploads/avatars/' . $filename ) );

        $user = is_null($user) ? auth()->user() : $user;
        $user->avatar = $filename;
        $user->save();

        return $user;
    }
}
