<?php

namespace App\Mail;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PetAdopted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * This is the actually logged in user
     */

    public $user;

    /**
     * This is the animal that was adopted
     */

    public $animal;

    /**
     * Create a new message instance.
     */

    public function __construct(User $user, Animal $animal)
    {
        $this->user = $user;
        $this->animal = $animal;
    }
 

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pet Adopted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.pet-adopted',
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
