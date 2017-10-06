<?php

namespace Genealogy;

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
        'avatar', 'name', 'phone', 'email', 'sex', 'password', 'confirmation_code', 'dob', 'dod'
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
        return $this->phone ? $this->phone : 'N/a';
    }

    /**
     * Tra ve email
     * @return string Email
     */
    public function getEmail()
    {
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
            ? asset("storage/images/users/{$this->avatar}")
            : 'http://via.placeholder.com/150x150';
    }
}
