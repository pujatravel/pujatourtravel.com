<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'module',
        'description',
        'ip_address',
        'location',
        'device',
        'user_agent',
        'properties',
    ];

    protected function casts(): array
    {
        return [
            'properties' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Dapatkan warna badge Tailwind berdasarkan tipe aksi.
     */
    public function getActionBadgeClassAttribute(): string
    {
        return match (strtoupper($this->action)) {
            'LOGIN' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'LOGOUT' => 'bg-slate-100 text-slate-700 border-slate-200',
            'APPROVE', 'ACC_TESTIMONI' => 'bg-teal-50 text-teal-700 border-teal-200 font-bold',
            'CREATE', 'UPLOAD' => 'bg-blue-50 text-blue-700 border-blue-200',
            'UPDATE', 'UPDATE_STATUS' => 'bg-amber-50 text-amber-800 border-amber-200',
            'DELETE' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-neutral-100 text-slate-700 border-neutral-200',
        };
    }

    /**
     * Dapatkan nama icon Lucide berdasarkan tipe aksi.
     */
    public function getActionIconAttribute(): string
    {
        return match (strtoupper($this->action)) {
            'LOGIN' => 'log-in',
            'LOGOUT' => 'log-out',
            'APPROVE', 'ACC_TESTIMONI' => 'check-circle-2',
            'CREATE' => 'plus-circle',
            'UPLOAD' => 'image-plus',
            'UPDATE', 'UPDATE_STATUS' => 'edit-3',
            'DELETE' => 'trash-2',
            default => 'activity',
        };
    }
}
