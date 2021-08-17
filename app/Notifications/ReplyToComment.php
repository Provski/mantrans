<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;


class ReplyToComment extends Notification
{
    use Queueable;

    /**   
     * The Reply Comment
     * @var commentreplies
     * 
     **/
    protected $commentreplies;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($commentreplies)
    {
        $this->commentreplies = $commentreplies;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // dd($notifiable);
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'reply'         =>$this->commentreplies,
            'commentreply'  =>Comment::find($this->commentreplies->comment_id),
            'user'          =>User::find($this->commentreplies->user_id),
            'messagereply'  =>'You had a new replied comment',
            'type'          =>'RepliedComment'
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];
    }
}
