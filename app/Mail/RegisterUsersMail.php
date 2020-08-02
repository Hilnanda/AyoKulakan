<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterUsersMail extends Mailable
{
    use Queueable, SerializesModels;
    public $record;
    public $pesan;
    public $urls;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($record, $pesan,$urls)
    {
        $this->record = $record;
        $this->pesan = $pesan;
        $this->urls = $urls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Selamat Bergabung DI Ayokulakan')->view('mails.users.registration-users');
    }
}
