<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class MailReserva extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $reservaContent,$reservaID;

    public function __construct($session,$reservaID)
    {
        $this->reservaContent = $session;
        $this->reservaID = $reservaID;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reseva hecha',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //encriptamos el id de la reserva
        $encriptadoReserva = Crypt::encryptString($this->reservaID);
        $linkCancelar = route("cancelarReserva",['id' => $encriptadoReserva]);

        return new Content(
            view: 'email.reservaEmail',
            with: [
                'direccion' => $this->reservaContent["restaurante"],
                'comensales' => $this->reservaContent["cantidad_comensales"],
                'fecha'=>$this->reservaContent["fecha_reservada"],
                'horario'=>$this->reservaContent["horario"],
                "link"=>$linkCancelar
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
