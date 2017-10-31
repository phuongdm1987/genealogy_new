<?php

namespace Genealogy\Hocs;

trait Paginable
{
    private $size;

    public function setPaginate($size = 25)
    {
        $this->size = $size;
    }
}
