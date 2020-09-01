<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $file = null)
    {
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this
            ->subject($this->data["subject"])->view('email.client')
            ->with($this->data);
        if (!empty($this->file))
            $mail->attachData($this->file, "declaracion_" . time() . ".pdf");
        return $mail;
    }
}
