<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Announcement;

class SystemAnnouncement extends Notification
{
    use Queueable;

    protected $announcement;

    /**
     * Create a new notification instance.
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $colors = [
            'info' => 'blue',
            'warning' => 'yellow',
            'danger' => 'red',
            'success' => 'green',
        ];

        $icons = [
            'info' => 'fas fa-info-circle',
            'warning' => 'fas fa-exclamation-triangle',
            'danger' => 'fas fa-exclamation-circle',
            'success' => 'fas fa-check-circle',
        ];

        return [
            'title' => $this->announcement->title,
            'message' => $this->announcement->message,
            'icon' => $icons[$this->announcement->type] ?? 'fas fa-bell',
            'color' => $colors[$this->announcement->type] ?? 'blue',
            'link' => null, // Announcements are displayed on dashboard, no specific link needed
        ];
    }
}
