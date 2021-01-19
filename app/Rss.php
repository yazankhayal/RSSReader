<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rss extends Model
{
    public $table = "rss_user";

    public $fillable = ['id', 'name',
        'user_id',
        'created_at', 'updated_at'];

    public $dates = ['created_at', 'updated_at'];
    public $primaryKey = 'id';

    public function User()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    function get_first_image_url($html)
    {
        {
            if (preg_match('/<img.+?src="(.+?)"/', $html, $matches)) {
                return $matches[1];
            } else echo '';
        }

    }
}
