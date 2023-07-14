<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Ticket $ticket)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $admin = User::where('role', 1)->first();

        return (new MailMessage)
            ->from($admin->email)
            ->greeting("Hello $notifiable->name")
            ->line('Ticket is updated.')
            ->action('Check Ticket', route('ticket.show', $this->ticket->id))
            ->line('Thank you for using our application!');
    }
}
