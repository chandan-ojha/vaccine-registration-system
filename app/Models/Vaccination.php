<?php

namespace App\Models;

use App\Enums\VaccinationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'nid',
        'phone',
        'status',
        'center_id',
        'notification_sent_at',
    ];

    protected $casts = [
        'status' => VaccinationStatus::class,
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function scheduled(): void
    {
        $this->status = VaccinationStatus::SCHEDULED;
        $this->save();
    }

    public function vaccinated(): void
    {
        $this->status = VaccinationStatus::VACCINATED;
        $this->save();
    }
}
