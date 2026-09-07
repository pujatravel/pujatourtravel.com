<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'package_id',
        'package_name',
        'travel_date',
        'pax_count',
        'total_price',
        'source',
        'notes',
        'admin_notes',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'pax_count' => 'integer',
        'total_price' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp '.number_format((float) $this->total_price, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'PENDING' => 'bg-amber-100 text-amber-800 border-amber-200',
            'DIPROSES' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
            'DIKONFIRMASI' => 'bg-blue-100 text-blue-800 border-blue-200',
            'SELESAI' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            'DIBATALKAN' => 'bg-rose-100 text-rose-800 border-rose-200',
            default => 'bg-slate-100 text-slate-800 border-slate-200',
        };
    }
}
