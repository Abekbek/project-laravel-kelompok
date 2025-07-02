<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTierList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tier_list_template_id',
        'ranking_data',
    ];

    public function template()
    {
        return $this->belongsTo(TierListTemplate::class, 'tier_list_template_id');
    }
}