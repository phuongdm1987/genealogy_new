<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmploymentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $employmentRepo;
    private $employment;
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->employmentRepo = app()->make(\Genealogy\Hocs\Employments\EmploymentRepository::class);
        $this->employment = factory(\Genealogy\Hocs\Employments\Employment::class)->create();
        $this->user = factory(\Genealogy\Hocs\Users\User::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $datas = [
            'company'     => 'Nguyen Ha',
            'position'    => 'CTO',
            'description' => 'Dang lam viec',
            'started_at'  => '2016-01-01',
            'is_current'  => 0,
            'current_id'  => $this->user->id,
        ];

        $employment = $this->employmentRepo->store($datas);

        $this->assertEquals('Nguyen Ha', $employment->company);
    }

    public function testUpdate()
    {
        $datas = [
            'is_current' => 1,
            'current_id'  => $this->user->id,
        ];
        $employment = $this->employmentRepo->update($this->employment, $datas);

        $this->assertEquals('Công việc hiện tại', $employment->getEndedAt());
    }

    public function testDelete()
    {
        $this->employmentRepo->delete($this->employment);
        $this->assertDatabaseMissing('employments', ['id' => $this->employment->id]);
    }
}
