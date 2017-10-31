<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EducationModelTest extends TestCase
{
    use RefreshDatabase;

    private $education;

    public function setUp()
    {
        parent::setup();

        $this->education = factory(\Genealogy\Hocs\Educations\Education::class)->create([
            'school'     => 'Bach Khoa Aptech',
            'subject'    => null,
            'degree'     => null,
            'started_at' => null,
            'ended_at'   => null,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetSubjectEmpty()
    {
        $this->assertEquals('N/a', $this->education->getSubject());
    }

    public function testGetSubject()
    {
        $this->education->subject = 'ACCP';
        $this->education->save();
        $this->assertEquals('ACCP', $this->education->getSubject());
    }

    public function testGetDegreeEmpty()
    {
        $this->assertEquals('N/a', $this->education->getDegree());
    }

    public function testGetDegree()
    {
        $this->education->degree = 'Master';
        $this->education->save();
        $this->assertEquals('Master', $this->education->getDegree());
    }

    public function testGetStartedAtEmpty()
    {
        $this->assertEquals('N/a', $this->education->getStartedAt());
    }

    public function testGetStartedAt()
    {
        $this->education->started_at = '2016-01-01 00:00:00';
        $this->education->save();
        $this->assertEquals('01-01-2016 00:00:00', $this->education->getStartedAt());
    }

    public function testGetStartedAtWithFormat()
    {
        $this->education->started_at = '2016-01-01 00:00:00';
        $this->education->save();
        $this->assertEquals('01-01-2016', $this->education->getStartedAt('d-m-Y'));
    }

    public function testGetEndedAtEmpty()
    {
        $this->assertEquals('N/a', $this->education->getEndedAt());
    }

    public function testGetEndedAt()
    {
        $this->education->ended_at = '2016-01-01 00:00:00';
        $this->education->save();
        $this->assertEquals('01-01-2016 00:00:00', $this->education->getEndedAt());
    }

    public function testGetEndedAtWithFormat()
    {
        $this->education->ended_at = '2016-01-01 00:00:00';
        $this->education->save();
        $this->assertEquals('01-01-2016', $this->education->getEndedAt('d-m-Y'));
    }

    public function testGetUser()
    {
        $user = factory(\Genealogy\Hocs\Users\User::class)->create();
        $this->education->user_id = $user->id;
        $this->education->save();

        $user_relation = $this->education->user;
        $this->assertEquals($user->id, $user_relation->id);
    }
}
