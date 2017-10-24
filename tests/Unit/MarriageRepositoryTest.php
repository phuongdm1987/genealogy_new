<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarriageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $marriageRepository;

    public function setUp()
    {
        parent::setup();
        $this->marriageRepository = app()->make(\Genealogy\Hocs\Marriages\MarriageRepository::class);
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

        $wife = $this->marriageRepository->store($data);

        $this->assertDatabaseHas('marriages', ['husband_id' => $user->id, 'wife_id' => $wife->id]);
        $this->assertDatabaseHas('users', ['id' => $wife->id, 'sex' => 0]);
    }
}
