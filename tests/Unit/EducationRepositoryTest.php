<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EducationRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $educationRepo;
    private $education;
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->educationRepo = app()->make(\Genealogy\Hocs\Educations\EducationRepository::class);
        $this->education = factory(\Genealogy\Hocs\Educations\Education::class)->create();
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
            'current_id'  => $this->user->id,
            'school'      => 'Bach Khoa Aptech',
            'subject'     => 'Technology',
            'degree'      => 'ACCP',
            'description' => 'Pass',
            'started_at'  => '2016-01-01',
        ];

        $education = $this->educationRepo->store($datas);

        $this->assertEquals('Bach Khoa Aptech', $education->school);
    }

    public function testUpdate()
    {
        $datas = [
            'current_id' => $this->user->id,
            'ended_at'   => null,
        ];
        $education = $this->educationRepo->update($this->education, $datas);

        $this->assertEquals('N/a', $education->getEndedAt());
    }

    public function testDelete()
    {
        $this->educationRepo->delete($this->education);
        $this->assertDatabaseMissing('educations', ['id' => $this->education->id]);
    }
}
