<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'template_id', 'sent_to', 'count',
    ];
}
