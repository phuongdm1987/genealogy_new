<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarriageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $marriageRepository;
    private $marriage;
    private $husband;
    private $wife;

    public function setUp()
    {
        parent::setup();
        $this->marriageRepository = app()->make(\Genealogy\Hocs\Marriages\MarriageRepository::class);

        $this->husband = factory(\Genealogy\Hocs\Users\User::class)->create([
            'sex' => 1
        ]);

        $this->wife = factory(\Genealogy\Hocs\Users\User::class)->create([
            'sex' => 0
        ]);

        $this->marriage = factory(\Genealogy\Hocs\Marriages\Marriage::class)->create([
            'husband_id' => $this->husband->id,
            'wife_id'    => $this->wife->id,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        \Storage::fake('avatar');

        $data = [
            'marriage' => [
                'started_at' => '2013-01-20',
                'is_end'     => false,
                'eneded'     => null,
            ],
            'user' => [
                'avatar'        => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg'),
                'avatar_width'  => 300,
                'avatar_height' => 300,
                'name'          => 'Cao Thi Doan',
                'email'         => 'doanct@gmail.com',
                'dob'           => '2017-10-30',
                'is_dead'       => false,
                'dod'           => null,
            ],
        ];

        $user = factory(\Genealogy\Hocs\Users\User::class)->create([
            'parent_id' => null,
            'sex' => 1
        ]);
        $this->actingAs($user);

        $result = $this->marriageRepository->store($data);

        $this->assertDatabaseHas('marriages', ['husband_id' => $user->id, 'wife_id' => $result['user']->id]);
        $this->assertDatabaseHas('users', ['id' => $result['user']->id, 'sex' => 0]);
    }

    public function testGetHusband()
    {
        $this->assertEquals($this->husband->email, $this->marriage->husband->email);
    }

    public function testGetWife()
    {
        $this->assertEquals($this->wife->email, $this->marriage->wife->email);
    }
}
