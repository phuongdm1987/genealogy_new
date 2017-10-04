<?php

namespace Genealogy\Hocs\Users;

use Genealogy\Hocs\BaseRepository;
use Genealogy\User;

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
        $data['password'] = bcrypt($data['password']);
        $data['confirmation_code'] = str_random(8) . "-" . base64_encode($data['email']);

        $model = $this->model->create($data);
        return $this->getById($model->id);
    }
}
