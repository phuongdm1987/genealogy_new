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
        $rules = [
            'phone' => [new \Genealogy\Rules\PhoneNumber]
        ];

        $data = [
            'phone' => '123123',
        ];

        $v = $this->app['validator']->make($data, $rules);
        $this->assertEquals('Trường phone phải là một số điện thoại.', $v->messages()->first('phone'));
    }

    public function testPhoneTenNumber()
    {
        $rules = [
            'phone' => [new \Genealogy\Rules\PhoneNumber]
        ];

        $data = [
            'phone' => '0972738921',
        ];

        $v = $this->app['validator']->make($data, $rules);
        $this->assertTrue($v->passes());
    }

    public function testPhoneElevenNumber()
    {
        $rules = [
            'phone' => [new \Genealogy\Rules\PhoneNumber]
        ];

        $data = [
            'phone' => '01682738921',
        ];

        $v = $this->app['validator']->make($data, $rules);
        $this->assertTrue($v->passes());
    }
}
