<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $record;
    public $title;
    public $subtitle;
    public $url;
    public $linkName;
    public $view;
    public $img;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$record,$title,$subtitle,$url,$linkName,$view,$img = '')
    {
        $this->email = $email;
        $this->record = $record;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->url = $url;
        $this->linkName = $linkName;
        $this->view = $view;
        $this->img = $img;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)->view($this->view);
    }
}
