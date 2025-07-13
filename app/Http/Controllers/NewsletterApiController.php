<?php
namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\NewsletterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsletterApiController extends Controller
{
    public function templates()
    {
        return response()->json(Template::all());
    }

    public function logs(Request $request)
    {
        $logs = NewsletterLog::orderByDesc('created_at')->paginate(50);
        return response()->json($logs);
    }
}
