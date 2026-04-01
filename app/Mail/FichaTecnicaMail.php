<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Encomenda;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class FichaTecnicaMail extends Mailable
{
    use Queueable, SerializesModels;

    public Encomenda $encomenda;
    protected ?string $attachmentPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Encomenda $encomenda, ?string $attachmentPath = null)
    {
        $this->encomenda = $encomenda;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ficha Tecnica Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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

    public function build()
    {
        $mail = $this->subject("Ficha Técnica - Encomenda #{$this->encomenda->id}")
            ->view('emails.ficha_tecnica')
            ->with(['encomenda' => $this->encomenda]);

        if ($this->attachmentPath && file_exists($this->attachmentPath)) {
            $mail->attach($this->attachmentPath);
        }

        return $mail;
    }

    /**
     * Helper usado nos testes para verificar se existe anexo.
     * Renomeado para evitar conflito com assinatura de Mailable::hasAttachment(...)
     */
    public function hasAttachmentPath(): bool
    {
        return !empty($this->attachmentPath) && file_exists($this->attachmentPath);
    }
}
