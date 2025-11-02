<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = ['user_id','title','body','image_path'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /** Số bài liên quan theo TÁC GIẢ (nhẹ, dùng cho danh sách) */
    public function getRelatedCountAttribute(): int
    {
        if (!$this->user_id) return 0;
        return static::where('user_id', $this->user_id)
            ->where('id', '<>', $this->id)
            ->count();
    }

    /** Lấy bài liên quan theo TỪ KHÓA TIÊU ĐỀ (dùng cho trang chi tiết) */
    public function relatedByTitle(int $limit = 6)
    {
        $title = Str::lower($this->title ?? '');
        $raw = preg_split('/[\s\p{P}]+/u', $title, -1, PREG_SPLIT_NO_EMPTY);

        $stop = [
            'va','và','hoac','hoặc','la','là','cua','của','nhung','những','mot','một','bai','bài','viet','viết',
            'the','and','or','a','an','of','for','to','in','on','by'
        ];

        $keywords = collect($raw)
            ->map(fn($w) => Str::ascii($w))
            ->filter(fn($w) => mb_strlen($w) >= 3 && !in_array($w, $stop))
            ->unique()
            ->take(5)
            ->values();

        if ($keywords->isEmpty()) {
            return static::where('id','<>',$this->id)
                ->where('user_id', $this->user_id)
                ->latest()->limit($limit)->get();
        }

        return static::where('id','<>',$this->id)
            ->where(function($q) use ($keywords) {
                foreach ($keywords as $k) {
                    $q->orWhere('title', 'LIKE', '%'.$k.'%');
                }
            })
            ->latest()->limit($limit)->get();
    }
}
