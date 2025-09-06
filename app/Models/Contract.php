<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_new_contract' => 'boolean',
        'admin_approved_at' => 'datetime',
        'legal_approved_at' => 'datetime',
        'marketing_approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contractFiles(): HasMany
    {
        return $this->hasMany(ContractFile::class);
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function () {
                $remainingDays = $this->remaining_days;

                if ($remainingDays < 0) {
                    return 'Habis';
                }

                if ($this->is_new_contract) {
                    if (is_null($this->admin_approved_at) || is_null($this->legal_approved_at) || is_null($this->marketing_approved_at)) {
                        return 'Pending';
                    }
                }

                if ($remainingDays <= 90) {
                    return 'Segera Habis';
                }

                return 'Aktif';
            }
        );
    }

    protected function statusDescription(): Attribute
    {
        return Attribute::make(
            get: function() {
                $status = $this->status;
                if ($status === 'Segera Habis') {
                    return "{$this->remaining_days} hari lagi";
                }
                return $status;
            }
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'Habis' => 'danger',
                'Pending' => 'warning',
                'Segera Habis' => 'warning',
                'Aktif' => 'success',
                default => 'gray',
            }
        );
    }

    protected function remainingDays(): Attribute
    {
        return Attribute::make(
            get: fn () => (int) now()->diffInDays($this->end_date, false)
        );
    }
}