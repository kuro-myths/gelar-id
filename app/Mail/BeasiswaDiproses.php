<?php

namespace App\Mail;

use App\Models\PendaftarBeasiswa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BeasiswaDiproses extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PendaftarBeasiswa $pendaftarBeasiswa,
        public string $statusBaru
    ) {}

    public function envelope(): Envelope
    {
        $subjek = match($this->statusBaru) {
            'diterima' => '🎉 Selamat! Beasiswa Anda Diterima — ' . $this->pendaftarBeasiswa->beasiswa->nama,
            'ditolak'  => '📋 Informasi Status Beasiswa — ' . $this->pendaftarBeasiswa->beasiswa->nama,
            default    => '🔍 Update Status Beasiswa — ' . $this->pendaftarBeasiswa->beasiswa->nama,
        };
        return new Envelope(subject: $subjek);
    }

    public function content(): Content
    {
        return new Content(view: 'email.beasiswa-diproses');
    }
}
