<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $userData;

    /**
     * Create a new message instance.
     *
     * @param array $userData
     * @param string $email
     * @return void
     */
    public function __construct(array $userData, string $email)
    {
        $this->userData = $userData;
        $this->to($email); // Define o destinatário do e-mail
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sgep@navalcadets.com')
                    ->subject('Bem-vindo ao Sistema de Gerenciamento Esportivo Público')
                    ->view('emails.user_registered');
    }
    /*public function build()
    {
        return $this->markdown('emails.test')->subject('Teste de Email');
    }*/


}
