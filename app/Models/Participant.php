<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Participant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name_one', 'name_two','lastname_one','lastname_two',
        'type','born','gender', 'deparment' , 'city' , 'type_document',
        'active', 'document', 'school'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $appends = ['name','years'];

    //relations

    public function getYearsAttribute()
    {
        $born = $this->attributes['born'];
        $hoy = Carbon\Carbon::now();

        $date_new = $hoy->format('Y-m-d');
        $year = $date_new-$born;
        return $year;
    }

    public function getNameAttribute()
    {
        $name = $this->attributes['name_one'].' '.$this->attributes['name_two'].' '.$this->attributes['lastname_one'].' '.$this->attributes['lastname_two'];
        return $name;
    }
}
