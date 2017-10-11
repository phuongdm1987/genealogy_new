<?php

namespace Genealogy\Hocs\Helpers;

use Genealogy\Hocs\Users\UserRepository;

class MarriageHelper
{
    public function __construct(
        UserRepository $user
    ) {
        $this->user = $user;
    }

    public function storeUser($datas)
    {
        return $this->user->storeCouple($datas);
    }
}
