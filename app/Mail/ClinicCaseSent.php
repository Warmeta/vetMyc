<?php

namespace App\Mail;

use App\ClinicCase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClinicCaseSent extends Mailable
{
    use Queueable, SerializesModels;

    public $clinic;
    public $clinicantibiotics;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ClinicCase $clinic, $clinicantibiotics)
    {
        $this->clinic = $clinic;
        $this->clinicantibiotics = $clinicantibiotics;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.clinicCase.view');
    }
}
