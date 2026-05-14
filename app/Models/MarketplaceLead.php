<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketplaceLead extends Model
{
    protected $fillable = [
        'type',
        'role',
        'name',
        'email',
        'company',
        'website',
        'message',
        'ip_address',
        'user_agent',
        'device',
        'operating_system',
        'country_code',
        'country',
        'city',
        'region',
        'latitude',
        'longitude',
        'metadata',
        'internal_notified_at',
        'confirmation_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'latitude' => 'float',
            'longitude' => 'float',
            'internal_notified_at' => 'datetime',
            'confirmation_sent_at' => 'datetime',
        ];
    }

    public function displayRole(): string
    {
        return match ($this->role) {
            'advertiser' => 'Media buyer / advertiser',
            'publisher' => 'Publisher',
            'agency' => 'Agency',
            default => 'Other',
        };
    }
}
