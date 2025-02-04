<?php

namespace effina\Larabanner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Larabanner extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'contents',
        'display_days',
        'display_start_date',
        'display_stop_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'display_days' => 'array',
        'display_start_date' => 'datetime',
        'display_stop_date' => 'datetime',
    ];

    /**
     * Determine if the banner should be displayed based on current date and time.
     *
     * @return bool
     */
    public function isDisplayable(): bool
    {
        $now = now();
        
        // Check if banner is within display date range
        if ($now < $this->display_start_date) {
            return false;
        }
        
        if ($this->display_stop_date && $now > $this->display_stop_date) {
            return false;
        }
        
        // Check if banner should be displayed on current day
        if ($this->display_days) {
            $currentDay = strtolower(date('D'));
            return in_array($currentDay, $this->display_days);
        }
        
        return true;
    }

    /**
     * Get the banner's remaining display time.
     *
     * @return string|null
     */
    public function getRemainingTime(): ?string
    {
        if (!$this->display_stop_date) {
            return null;
        }

        if ($this->display_stop_date < now()) {
            return 'Expired';
        }

        return $this->display_stop_date->diffForHumans();
    }

    /**
     * Scope a query to only include currently active banners.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('display_start_date', '<=', now())
            ->where(function ($query) {
                $query->whereNull('display_stop_date')
                    ->orWhere('display_stop_date', '>=', now());
            });
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Yourusername\Larabanner\Database\Factories\SiteBannerFactory::new();
    }
}
