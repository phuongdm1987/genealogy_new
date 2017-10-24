<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setup();

        $this->user = factory(\Genealogy\Hocs\Users\User::class)->create([
            'confirmation_code' => '123',
            'sex'               => 0,
            'avatar'            => '',
            'phone'             => '0972738921',
            'phone_visibile'    => 1,
            'email_visibile'    => 0,
            'dob'               => '1987-12-27 00:00:00',
            'dod'               => null,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsMan()
    {
        $this->assertFalse($this->user->isMan());
    }

    public function testIsDead()
    {
        $this->assertFalse($this->user->isDead());
    }

    public function testGetSex()
    {
        $this->assertEquals('Nữ', $this->user->getSex());
    }

    public function testGetSexIcon()
    {
        $this->assertEquals('fi-female-symbol', $this->user->getSexIcon());
    }

    public function testGetPhoneEmpty()
    {
        $this->user->phone = '';
        $this->user->save();

        $this->assertEquals('N/a', $this->user->getPhone());
    }

    public function testGetPhone()
    {
        $this->assertEquals('0972738921', $this->user->getPhone());
    }

    public function testGetEmail()
    {
        $this->assertEquals('Riêng tư', $this->user->getEmail());
    }

    public function testGetDob()
    {
        $this->assertEquals('27-12-1987 00:00:00', $this->user->getDob());
    }

    public function testGetDobWithFormat()
    {
        $this->assertEquals('1987-12-27', $this->user->getDob('Y-m-d'));
    }

    public function testGetDod()
    {
        $this->assertEquals('N/a', $this->user->getDod());
    }

    public function testGetAvatarEmpty()
    {
        $this->assertEquals('http://via.placeholder.com/150x150', $this->user->getAvatar());
    }

    public function testGetAvatar()
    {
        $this->user->avatar = 'avatar.jpg';
        $this->user->save();
        $this->assertEquals('http://genealogy.dev/storage/uploads/avatars/avatar.jpg', $this->user->getAvatar());
    }

    public function testGetParents()
    {
        $parent = factory(\Genealogy\Hocs\Users\User::class)->create([
            'sex' => 1
        ]);
        $wife_of_parent = factory(\Genealogy\Hocs\Users\User::class)->create([
            'sex' => 0
        ]);
        $marriage = factory(\Genealogy\Hocs\Marriages\Marriage::class)->create([
            'husband_id' => $parent->id,
            'wife_id' => $wife_of_parent->id,
        ]);

        $this->user->parent_id = $parent->id;
        $this->user->save();
        $parents = $this->user->getParents()->toArray();
        $this->assertCount(2, $parents);
    }
}
