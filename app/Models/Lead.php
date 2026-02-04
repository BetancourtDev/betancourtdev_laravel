<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUALIFIED = 'qualified';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_SPAM = 'spam';

    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_CONTACTED,
        self::STATUS_QUALIFIED,
        self::STATUS_CLOSED,
        self::STATUS_SPAM,
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'ip',
        'user_agent',
        'status',
        'contacted_at',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
    ];

    // -------- Scopes (para mantener controller limpio) --------

    public function scopeLatestFirst(Builder $q): Builder
    {
        return $q->latest();
    }

    public function scopeSearch(Builder $q, ?string $term): Builder
    {
        $term = trim((string) $term);
        if ($term === '') return $q;

        return $q->where(function (Builder $w) use ($term) {
            $w->where('name', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('message', 'like', "%{$term}%");
        });
    }

    public function scopeStatus(Builder $q, ?string $status): Builder
    {
        if (!$status || !in_array($status, self::STATUSES, true)) return $q;
        return $q->where('status', $status);
    }

    public function scopeSource(Builder $q, ?string $source): Builder
    {
        $source = trim((string) $source);
        if ($source === '') return $q;

        return $q->where('source', $source);
    }

    public function scopeDateBetween(Builder $q, ?string $from, ?string $to): Builder
    {
        if ($from) $q->whereDate('created_at', '>=', $from);
        if ($to)   $q->whereDate('created_at', '<=', $to);
        return $q;
    }

    // -------- Domain actions (más expresivo) --------

    public function setStatus(string $status): void
    {
        $this->status = $status;

        if ($status === self::STATUS_CONTACTED && !$this->contacted_at) {
            $this->contacted_at = now();
        }
    }

    public function markContacted(): void
    {
        if ($this->status !== self::STATUS_SPAM) {
            $this->status = self::STATUS_CONTACTED;
        }

        $this->contacted_at = now();
    }

    public function scopeFilter($query, array $filters = [], bool $ignoreStatus = false)
    {
        return $query
            ->when(!empty($filters['q']), function ($q) use ($filters) {
                $term = trim($filters['q']);
                $q->where(function ($w) use ($term) {
                    $w->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('message', 'like', "%{$term}%");
                });
            })
            ->when(!$ignoreStatus && !empty($filters['status']), fn($q) => $q->where('status', $filters['status']))
            ->when(!empty($filters['source']), fn($q) => $q->where('source', $filters['source']))
            ->when(!empty($filters['from']), fn($q) => $q->whereDate('created_at', '>=', $filters['from']))
            ->when(!empty($filters['to']), fn($q) => $q->whereDate('created_at', '<=', $filters['to']));
    }
}
