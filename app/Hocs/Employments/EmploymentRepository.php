<?php

namespace Genealogy\Hocs\Employments;

interface EmploymentRepository
{
    public function getById($id, $withoutScope = null);
    public function getByIdWithTrash($id);
    public function getByParam($params, $getSql = false, $withoutScope = null);
    public function store($data);
    public function update($model, $data);
    public function delete($model);
    public function destroy($model);
    public function restore($model);
}
