<?php

namespace Genealogy\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailInvite extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user     = $user;
        $this->password = $password;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invite')
            ->subject("Xác thực tài khoản " . env('APP_NAME'))
            ->with([
                'confirmation_code' => $this->user->confirmation_code,
                'password'          => $this->password,
            ]);
    }
}
