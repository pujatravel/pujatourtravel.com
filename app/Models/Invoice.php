<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'travel_date',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'package_id',
        'package_name',
        'pax_count',
        'status',
        'payment_method',
        'bank_details',
        'subtotal',
        'discount',
        'tax_percent',
        'tax_amount',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'notes',
        'admin_notes',
        'created_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'travel_date' => 'date',
        'pax_count' => 'integer',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax_percent' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class)->orderBy('display_order')->orderBy('id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Auto generate next invoice number: INV-YYYYMMDD-XXXX
     */
    public static function generateInvoiceNumber(): string
    {
        $datePrefix = 'INV-' . date('Ymd') . '-';
        $latest = self::withTrashed()
            ->where('invoice_number', 'like', $datePrefix . '%')
            ->orderBy('invoice_number', 'desc')
            ->first();

        if ($latest) {
            $lastNum = (int) substr($latest->invoice_number, strlen($datePrefix));
            $nextNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNum = '0001';
        }

        return $datePrefix . $nextNum;
    }

    // Currency Formatting Accessors
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getFormattedDiscountAttribute(): string
    {
        return 'Rp ' . number_format($this->discount, 0, ',', '.');
    }

    public function getFormattedTaxAttribute(): string
    {
        return 'Rp ' . number_format($this->tax_amount, 0, ',', '.');
    }

    public function getFormattedPaidAttribute(): string
    {
        return 'Rp ' . number_format($this->paid_amount, 0, ',', '.');
    }

    public function getFormattedRemainingAttribute(): string
    {
        return 'Rp ' . number_format($this->remaining_amount, 0, ',', '.');
    }

    // Status helpers
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'PAID' => 'Lunas',
            'PARTIAL' => 'Uang Muka (DP)',
            'CANCELLED' => 'Dibatalkan',
            default => 'Belum Bayar',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'PAID' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'PARTIAL' => 'bg-amber-50 text-amber-800 border-amber-200',
            'CANCELLED' => 'bg-slate-100 text-slate-600 border-slate-200',
            default => 'bg-rose-50 text-rose-700 border-rose-200',
        };
    }

    /**
     * Clean phone number for WhatsApp link
     */
    public function getCleanPhoneAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->customer_phone ?? '');
        if (str_starts_with($phone, '08')) {
            $phone = '628' . substr($phone, 2);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '628' . substr($phone, 1);
        }
        return $phone;
    }

    /**
     * Generate WhatsApp share text message
     */
    public function getWhatsappShareUrlAttribute(): string
    {
        $phone = $this->clean_phone;
        $company = Setting::get('company_name', 'Puja Tour & Travel Pangandaran');
        
        $msg = "Halo Kak *{$this->customer_name}*,\n\n";
        $msg .= "Berikut kami kirimkan rincian *Invoice Resmi* dari *{$company}*:\n";
        $msg .= "──────────────────────\n";
        $msg .= "📄 *No. Invoice:* {$this->invoice_number}\n";
        $msg .= "📅 *Tgl Terbit:* " . ($this->invoice_date ? $this->invoice_date->format('d/m/Y') : '-') . "\n";
        if ($this->travel_date) {
            $msg .= "🌴 *Tgl Wisata:* " . $this->travel_date->format('d/m/Y') . "\n";
        }
        if ($this->package_name) {
            $msg .= "🏷️ *Paket:* {$this->package_name}\n";
        }
        $msg .= "👥 *Peserta:* {$this->pax_count} Orang\n";
        $msg .= "──────────────────────\n";
        $msg .= "💰 *Total Tagihan:* {$this->formatted_total}\n";
        
        if ($this->paid_amount > 0) {
            $msg .= "✅ *Terbayar (DP):* {$this->formatted_paid}\n";
            $msg .= "⏳ *Sisa Pelunasan:* {$this->formatted_remaining}\n";
        }
        
        $msg .= "📌 *Status:* *" . strtoupper($this->status_label) . "*\n";
        
        if ($this->bank_details) {
            $msg .= "\n💳 *Informasi Pembayaran / Transfer:*\n" . $this->bank_details . "\n";
        }

        $publicUrl = route('invoice.public', $this->invoice_number);
        $msg .= "\n🔗 *Lihat / Unduh Invoice Online:*\n{$publicUrl}\n\n";
        $msg .= "Terima kasih atas kepercayaannya bersama *{$company}*! 🙏🌴";

        return "https://api.whatsapp.com/send?phone={$phone}&text=" . urlencode($msg);
    }
}
