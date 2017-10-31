<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmploymentModelTest extends TestCase
{
    use RefreshDatabase;

    private $employment;

    public function setUp()
    {
        parent::setup();

        $this->employment = factory(\Genealogy\Hocs\Employments\Employment::class)->create([
            'company'    => 'Nguyen Ha',
            'position'   => null,
            'is_current' => 0,
            'started_at' => null,
            'ended_at'   => null,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPositionEmpty()
    {
        $this->assertEquals('N/a', $this->employment->getPosition());
    }

    public function testGetPosition()
    {
        $this->employment->position = 'CTO';
        $this->employment->save();
        $this->assertEquals('CTO', $this->employment->getPosition());
    }

    public function testGetStartedAtEmpty()
    {
        $this->assertEquals('N/a', $this->employment->getStartedAt());
    }

    public function testGetStartedAt()
    {
        $this->employment->started_at = '2016-01-01 00:00:00';
        $this->employment->save();
        $this->assertEquals('01-01-2016 00:00:00', $this->employment->getStartedAt());
    }

    public function testGetStartedAtWithFormat()
    {
        $this->employment->started_at = '2016-01-01 00:00:00';
        $this->employment->save();
        $this->assertEquals('01-01-2016', $this->employment->getStartedAt('d-m-Y'));
    }

    public function testGetEndedAtEmpty()
    {
        $this->assertEquals('N/a', $this->employment->getEndedAt());
    }

    public function testGetEndedAt()
    {
        $this->employment->ended_at = '2016-01-01 00:00:00';
        $this->employment->save();
        $this->assertEquals('01-01-2016 00:00:00', $this->employment->getEndedAt());
    }

    public function testGetEndedAtWithFormat()
    {
        $this->employment->ended_at = '2016-01-01 00:00:00';
        $this->employment->save();
        $this->assertEquals('01-01-2016', $this->employment->getEndedAt('d-m-Y'));
    }

    public function testGetEndedAtIsCurrent()
    {
        $this->employment->is_current = 1;
        $this->employment->save();
        $this->assertEquals('Công việc hiện tại', $this->employment->getEndedAt());
    }

    public function testGetUser()
    {
        $user = factory(\Genealogy\Hocs\Users\User::class)->create();
        $this->employment->user_id = $user->id;
        $this->employment->save();

        $user_relation = $this->employment->user;
        $this->assertEquals($user->id, $user_relation->id);
    }
}
