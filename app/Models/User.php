<?php

namespace App\Models;

use App\Support\FilterPaginateOrder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;
    use FilterPaginateOrder;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'rol' , 'email', 'password','codeActive' , 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $filter = [
        'id', 'uuid' , 'name', 'email', 'phone', 'avatar' , 'created_at'
    ];

    protected $appends = ['url_avatar'];
    public static function initialize()
    {
        return [
            'id' => '',
            'uuid' => '',
            'name' => '',
            'email' => '',
            'avatar' => '',
            'phone' => '',
        ];
    }

    public function setAvatarAttribute($file){

        if($file != 'user.gif') {
            if (!is_string($file)) {
                $name = $file->getClientOriginalName();
                $this->attributes['avatar'] = $name;
                \Storage::disk($this->folder)->put('/profile/' . $name, \File::get($file));
            } else {
                //get the base-64 from data
                $base64_str = substr($file, strpos($file, ",") + 1);
                //decode base64 string
                $image = base64_decode($base64_str);
                $png_url = "image-" . Uuid::generate(4)->string . ".png";
                $path = public_path() . "/profile/";
                \Storage::disk($this->folder)->makeDirectory("/profile/");
                file_put_contents($path . $png_url, $image);
                $this->attributes['avatar'] = $png_url;
            }
        }

    }

    public function getUrlAvatarAttribute()
    {

        $url = $this->attributes['avatar'];
        $url_avatar = url('/').'/profile/'.$url;
        return $url_avatar;

    }

    //relations

    public function invoices()
    {
        return $this->hasMany(Field::class);
    }

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
