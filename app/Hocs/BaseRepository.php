<?php

namespace Genealogy\Hocs;

abstract class BaseRepository
{
    use Relationable, Paginable;

    /**
     * Eloquent model
     * @var Eloquent
     */
    protected $model;

    /**
     * Lấy thông tin 1 bản ghi xác định bởi ID
     *
     * @param  integer $id ID bản ghi
     * @return Eloquent
     */
    public function getById($id, $withoutScope = null)
    {
        $model = $withoutScope == 'withoutScope' ? $this->model->withoutGlobalScope('user') : $this->model;
        return $model->findOrFail($id);
    }

    /**
     * Lấy thông tin 1 bản ghi xác định bởi ID
     *
     * @param  integer $id ID bản ghi
     * @return Eloquent
     */
    public function getByIdWithTrash($id)
    {
        return $this->model->withTrashed()->findOrFail($id);
    }

    /**
     * tim kiem thong tin tra ve danh sach ban ghi
     * @param  array        $params     mang tham so can tim kiem
     * @param  array        $sorting    mang key:value can sap xep
     * @return Collection               danh sach ban ghi
     */
    public function getByParam($params, $getSql = false, $withoutScope = null)
    {
        $sort  = array_get($params, 'sort', []);

        $query = \Genealogy\Hocs\FilterFactory::apply($params, $this->model);
        $query = \Genealogy\Hocs\Helpers\Sorting::apply($sort, $query);

        $query->with($this->relations);

        if ($withoutScope == 'withoutScope') {
            $query->withoutGlobalScope('user');
        }

        if ($getSql) {
            return $query;
        }

        switch ($this->size) {
            case -1:
            case 0:
                return $query->get();
                break;

            case 1:
                return $query->first();
                break;

            default:
                return $query->paginate($this->size);
                break;
        }
    }

    /**
     * Lưu thông tin 1 bản ghi mới
     *
     * @param  array $data
     * @return Eloquent
     */
    public function store($data)
    {
        $model = $this->model->create($data);
        return $this->getById($model->id);
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
        return $this->getById($model->id, 'withoutScope');
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
        return $model->delete();
    }

    /**
     * Xóa hoàn toàn một bản ghi
     * @param  object $model Bản ghi hien tai
     * @return bool|null
     */
    public function destroy($model)
    {
        return $model->forceDelete();
    }

    /**
     * Khôi phục 1 bản ghi SoftDeletes đã xóa
     * @param  object $model Bản ghi hien tai
     * @return bool|null
     */
    public function restore($model)
    {
        return $model->restore();
    }
}
