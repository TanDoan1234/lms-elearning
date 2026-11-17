<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'title', 'type', 'video_path', 'video_url', 'document_path', 'content', 'duration_minutes', 'position', 'is_preview'];

    protected function casts(): array
    {
        return ['duration_minutes' => 'integer', 'position' => 'integer', 'is_preview' => 'boolean'];
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function completedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('completed_at');
    }

    /** YouTube embed URL (/embed/{id}); YouTube refuses to be framed via watch?v= links. */
    protected function embedUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->video_url) {
                return null;
            }
            if (preg_match('~(?:youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $this->video_url, $m)) {
                return 'https://www.youtube.com/embed/'.$m[1].'?enablejsapi=1&rel=0';
            }

            return $this->video_url;
        });
    }
}
