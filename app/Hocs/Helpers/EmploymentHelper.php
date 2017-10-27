<?php

namespace Genealogy\Hocs\Helpers;

use Genealogy\Hocs\Users\UserRepository;

class EmploymentHelper
{
    private $userRepo;

    public function __construct(
        UserRepository $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function getUserById($user_id)
    {
        return $this->userRepo->getById($user_id);
    }
}
