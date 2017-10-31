<?php

namespace Tests\Unit;

use Tests\TestCase;

class ValidatePhoneTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPhoneFail()
    {
        $phone_validate = app('Genealogy\Rules\PhoneNumber');
        $result = $phone_validate->passes('phone', '123');

        $this->assertEquals(false, $result);
    }

    public function testPhoneSuccess()
    {
        $phone_validate = app('Genealogy\Rules\PhoneNumber');
        $result = $phone_validate->passes('phone', '0972738921');

        $this->assertEquals(true, $result);
    }
}
