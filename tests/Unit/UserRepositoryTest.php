<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;
    private $user;
    private $data;

    public function setUp()
    {
        parent::setup();
        $this->userRepository = app()->make(\Genealogy\Hocs\Users\UserRepository::class);

        $parent = factory(\Genealogy\Hocs\Users\User::class)->create();

        $this->user = factory(\Genealogy\Hocs\Users\User::class)->create([
            'confirmation_code' => '123',
            'sex'               => 0,
            'parent_id'         => $parent->id,
            'avatar'            => '',
        ]);

        $this->data = [
            'name'          => 'Henry',
            'email'         => 'phuongdm1987@yahoo.com',
            'password'      => 'secret',
        ];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByConfirmCode()
    {
        $user = $this->userRepository->getByConfirmCode($this->user->confirmation_code);
        $this->assertEquals($user->confirmation_code, $this->user->confirmation_code);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        \Storage::fake('avatar');

        $data = array_merge($this->data, [
            'avatar'        => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg'),
            'avatar_width'  => 300,
            'avatar_height' => 300,
        ]);

        $user = $this->userRepository->store($data);
        $this->assertEquals($user->email, 'phuongdm1987@yahoo.com');
        $this->assertEquals($user->hashid, \Hashids::encode($user->id));

        $this->assertTrue(\Hash::check('secret', $user->password));
        $this->assertFalse(is_null($user->avatar));
    }

    public function testUpdate()
    {
        \Storage::fake('avatar');

        $data = [
            'name'          => 'Henry Duong',
            'email'         => 'phuongdm19871@yahoo.com',
            'password'      => 'secret1',
            'sex'           => 1,
            'avatar'        => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg'),
            'avatar_width'  => 300,
            'avatar_height' => 300,
        ];

        $user = $this->userRepository->update($this->user, $data);
        $this->assertNotEquals($user->email, 'phuongdm19871@yahoo.com');

        $this->assertFalse(\Hash::check('secret1', $user->password));
        $this->assertFalse(is_null($user->avatar));
        $this->assertNotEquals(1, $user->sex);
    }

    public function testStoreCouple()
    {
        $this->actingAs($this->user);

        $data = array_merge(['current_id' => $this->user->id], $this->data);

        $user = $this->userRepository->storeCouple($data);
        $this->assertEquals($user->sex, 1);
    }

    public function testStoreSibling()
    {
        $this->actingAs($this->user);

        $data = array_merge(['parent_id' => $this->user->parent_id], $this->data);

        $user = $this->userRepository->storeSibling($data);
        $this->assertEquals($this->user->parent_id, $user->parent_id);
    }

    public function testStoreChild()
    {
        $this->actingAs($this->user);

        $data = array_merge(['parent_id' => $this->user->id], $this->data);

        $user = $this->userRepository->storeChild($data);
        $this->assertEquals($this->user->id, $user->parent_id);
    }

    public function testDelete()
    {
        $husband = factory(\Genealogy\Hocs\Users\User::class)->create([
            'sex' => 1,
        ]);

        $marriage = factory(\Genealogy\Hocs\Marriages\Marriage::class)->create([
            'wife_id'    => $this->user->id,
            'husband_id' => $husband->id,
        ]);

        $this->userRepository->delete($this->user);
        $this->assertDatabaseMissing('users', ['id' => $this->user->id]);
        $this->assertDatabaseMissing('marriages', ['husband_id' => $husband->id]);
    }

    public function testUploadAvatar()
    {
        $this->actingAs($this->user);

        \Storage::fake('avatar');

        $file = \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg');

        $this->userRepository->uploadAvatar($file, 300, 300, 0, 0);
        $this->assertFalse(is_null($this->user->avatar));
    }

    public function testGetByParam()
    {
        $params = [
            'q' => $this->user->phone
        ];
        $this->userRepository->setPaginate(1);
        $user = $this->userRepository->getByParam($params);

        $this->assertEquals($user->phone, $this->user->phone);
    }
}
