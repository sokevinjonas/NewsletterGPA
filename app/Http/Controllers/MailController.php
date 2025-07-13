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
            'send_to' => 'nullable|in:all,week',
        ]);
        $template = Template::findOrFail($request->template_id);
        $query = Subscriber::query();
        if ($request->send_to === 'week') {
            $query->where('created_at', '>=', now()->startOfWeek());
        }
        $subscribers = $query->get();
        foreach ($subscribers as $subscriber) {
            SendNewsletterJob::dispatch($subscriber, $template);
        }
        \App\Models\NewsletterLog::create([
            'title' => $template->title,
            'template_id' => $template->id,
            'sent_to' => $request->send_to ?? 'all',
            'count' => $subscribers->count(),
        ]);
        return response()->json(['success' => true]);
    }
}
