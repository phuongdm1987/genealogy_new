<?php

namespace Genealogy\Hocs;

trait Relationable
{
    private $relations = [];

    public function setRelations($relations = [])
    {
        $this->relations = $relations;
    }
}
