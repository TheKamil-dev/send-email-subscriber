<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['website_name', 'website_slug'];

    public function setWebsiteNameAttribute($value)
    {
        $this->attributes['website_name'] = $value;
        if(!empty($value)) {
            $this->attributes['website_slug'] = Helper::slugify($value);
        }
    }

}
