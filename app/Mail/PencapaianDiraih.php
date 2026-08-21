<?php

namespace App\Mail;

use App\Models\PencapaianPengguna;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PencapaianDiraih extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PencapaianPengguna $pencapaianPengguna) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🏆 Pencapaian Baru Diraih: ' . $this->pencapaianPengguna->pencapaian->nama,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'email.pencapaian-diraih');
    }
}
