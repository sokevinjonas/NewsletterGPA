<?php
namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Jobs\SendNewsletterJob;

class MailController extends Controller
{
    public function showSendForm()
    {
        $templates = Template::all();
        return view('newsletter.send', compact('templates'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);
        $template = Template::findOrFail($request->template_id);
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            SendNewsletterJob::dispatch($subscriber, $template);
        }
        return back()->with('success', 'Newsletter envoyée à tous les abonnés.');
    }
}
