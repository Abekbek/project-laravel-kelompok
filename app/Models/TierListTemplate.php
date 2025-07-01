<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TierListTemplate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user() { return $this->belongsTo(User::class); }
    public function tierRows() { return $this->hasMany(TierRow::class)->orderBy('order'); }
    public function items()
    {
        return $this->hasMany(TemplateItem::class);
    }
}
