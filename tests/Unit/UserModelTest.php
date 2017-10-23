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
    public function testGetSex()
    {
        $this->assertEquals('Nữ', $this->user->getSex());
    }

    public function testIsMan()
    {
        $this->assertFalse($this->user->isMan());
    }

    public function testGetSexIcon()
    {
        $this->assertEquals('fi-female-symbol', $this->user->getSexIcon());
    }

    public function getPhoneEmpty()
    {
        $this->user->phone = '';
        $this->user->save();

        $this->assertEquals('N/a', $this->user->getPhone());
    }

    public function getPhone()
    {
        $this->assertEquals('0972738921', $this->user->getPhone());
    }

    public function getEmail()
    {
        $this->assertEquals('Riêng tư', $this->user->getEmail());
    }

    public function getDob()
    {
        $this->assertEquals('2017-12-27 00:00:00', $this->user->getDob());
    }

    public function getDobWithFormat()
    {
        $this->assertEquals('2017-12-27', $this->user->getDob('Y-m-d'));
    }

    public function getDod()
    {
        $this->assertEquals('N/a', $this->user->getDod());
    }

    public function isDead()
    {
        $this->assertFalse($this->user->isDead());
    }
}
