<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TemplateItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function template() { return $this->belongsTo(TierListTemplate::class, 'tier_list_template_id'); }
}
