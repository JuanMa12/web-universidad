<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'gender', 'years' , 'document' , 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'document'
    ];

    //relations

    public function calendars()
    {
        return $this->hasMany('App\Calendar');
    }

    public function favorites()
    {
        return $this->hasMany('App\FavoritesField');
    }

    //methods

    public static function byUuid($id)
    {
        return static::where('uuid', $id)->first();
    }

    public function avatar()
    {
        return 'http://www.gravatar.com/avatar/'.md5($this->email).'?s=356d-nm';
    }
}
