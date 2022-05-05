<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Website;

class Post extends Model
{
    use HasFactory;

    //protected $table = '';

    protected $guarded = ['id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function notifiers()
    {
        return $this->belongsToMany(User::class, 'notifications')->withTimestamps();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

    public function publish()
    {
        // Check if is in draft mode
        if($this->status === 'PUBLISHED'){
            return false;
        }

        return $this->update(['status' => 'PUBLISHED']);
    }
}
