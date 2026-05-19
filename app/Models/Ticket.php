<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_RESOLVED = 'resolved';
    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'status',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_NEW => 'Naujas',
            self::STATUS_IN_PROGRESS => 'Vykdomas',
            self::STATUS_RESOLVED => 'Užbaigtas',
            self::STATUS_CLOSED => 'Uždarytas',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class)->latest();
    }

    public function statusLabel(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function isActive(): bool
    {
        return !in_array($this->status, [self::STATUS_RESOLVED, self::STATUS_CLOSED], true);
    }
}
