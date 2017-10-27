<?php

namespace Genealogy\Hocs\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

class User extends Authenticatable
{
    use Notifiable, NodeTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['dob', 'dod'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'name', 'phone', 'email', 'sex', 'password', 'confirmation_code',
        'dob', 'dod', 'parent_id', 'phone_visibile', 'email_visibile'
    ];

    protected static $arr_sex = [
        'Nữ', 'Nam'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ep kieu du lieu gioi tinh khi luu
     * @param void
     */
    public function setSexAttribute($value)
    {
        $this->attributes['sex'] = (int) $value;
    }

    /**
     * Tra ve text hien thi gioi tinh
     * @return string Gioi tinh
     */
    public function getSex()
    {
        return array_key_exists($this->sex, self::$arr_sex) ? self::$arr_sex[$this->sex] : 'N/a';
    }

    /**
     * Kiem tra con trai hay gai
     * @return boolean True: con trai | false: con gai
     */
    public function isMan()
    {
        return $this->sex ? true : false;
    }

    /**
     * Tra ve icon hien thi gioi tinh
     * @return string Gioi tinh
     */
    public function getSexIcon()
    {
        return $this->sex ? 'fi-male-symbol' : 'fi-female-symbol';
    }

    /**
     * Tra ve so dien thoai
     * @return string SDT
     */
    public function getPhone()
    {
        if (!$this->phone_visibile) {
            return 'riêng tư';
        }

        return $this->phone ? $this->phone : 'N/a';
    }

    /**
     * Tra ve email
     * @return string Email
     */
    public function getEmail()
    {
        if (!$this->email_visibile) {
            return 'Riêng tư';
        }

        return $this->email ? $this->email : 'N/a';
    }

    /**
     * Tra ve ngay sinh
     * @param  string $format Dinh dang
     * @return string         Ngay sinh
     */
    public function getDob($format = 'd-m-Y H:i:s')
    {
        return $this->dob ? $this->dob->format($format) : 'N/a';
    }

    /**
     * Tra ve ngay mat
     * @param  string $format Dinh dang
     * @return string         Ngay mat
     */
    public function getDod($format = 'd-m-Y H:i:s')
    {
        return $this->dod ? $this->dod->format($format) : 'N/a';
    }

    /**
     * Kiem tra da mat hay chua
     * @return boolean True: da mat | false: con song
     */
    public function isDead()
    {
        return $this->dod ? true : false;
    }

    /**
     * Tra ve duong dan anh dai dien
     * @return string Duong dan anh
     */
    public function getAvatar()
    {
        return $this->avatar
            ? asset("storage/uploads/avatars/{$this->avatar}")
            : 'http://via.placeholder.com/150x150';
    }

    /**
     * Tra ve danh sach Bo me thuoc user hien tai
     * @return Collection Children
     */
    public function getParents()
    {
        if (!$this->parent) {
            return null;
        }

        $parents = collect([$this->parent]);

        foreach ($this->parent->couple as $wife) {
            $parents->push($wife);
        }

        return $parents;
    }

    /**
     * Tra ve danh sach con cai thuoc user hien tai va thuoc vo / chong cua user hien tai
     * @return Collection Children
     */
    public function getChildren()
    {
        $children = collect($this->children);

        foreach ($this->couple as $wife) {
            foreach ($wife->children as $child) {
                $children->push($child);
            }
        }

        return $children;
    }

    public function getSiblingsWithoutCouple()
    {
        $couples = $this->couple->pluck('id', 'id');
        return $this->getSiblings()->whereNotIn('id', $couples);
    }

    /**
     * Lay ra danh sach cac cuoc hon nhan
     * @return Collection marriages
     */
    public function marriages()
    {
        $foreign_key = $this->isMan() ? 'husband_id' : 'wife_id';
        return $this->hasMany('Genealogy\Hocs\Marriages\Marriage', $foreign_key, 'id');
    }

    /**
     * Lay ra danh sach nghe nghiep
     * @return [type] [description]
     */
    public function employments()
    {
        return $this->hasMany('Genealogy\Hocs\Employments\Employment', 'user_id', 'id');
    }

    /**
     * Lay ra danh sach vo (chong)
     * @return Collection user
     */
    public function couple()
    {
        $first_key = $this->isMan() ? 'husband_id' : 'wife_id';
        $last_key = !$this->isMan() ? 'husband_id' : 'wife_id';
        return $this->belongsToMany('Genealogy\Hocs\Users\User', 'marriages', $first_key, $last_key);
    }
}
