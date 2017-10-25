<?php

namespace Genealogy\Hocs\Helpers;

use Genealogy\Hocs\Users\UserRepository;

class MarriageHelper
{
    private $userRepo;

    public function __construct(
        UserRepository $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function storeUser($datas)
    {
        return $this->userRepo->storeCouple($datas);
    }

    public function getUserById($user_id)
    {
        return $this->userRepo->getById($user_id);
    }
}
