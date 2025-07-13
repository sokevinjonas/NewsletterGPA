<?php
namespace App\Jobs;

use App\Models\Subscriber;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subscriber;
    public $template;

    public function __construct(Subscriber $subscriber, Template $template)
    {
        $this->subscriber = $subscriber;
        $this->template = $template;
    }

    public function handle(): void
    {
        Mail::send([], [], function ($message) {
            $message->to($this->subscriber->email)
                ->subject($this->template->title)
                ->setBody($this->template->content, 'text/html');
        });
    }
}
