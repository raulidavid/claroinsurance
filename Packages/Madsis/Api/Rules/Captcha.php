<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class Captcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Lcz6ZoUAAAAAGWkHBjnQUlfAwNm1EAaDDfl4e6V',
                    'response'=>$value
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        return $body->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
