<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Customers extends Moloquent
{

    protected $table = 'customers';

    protected $fillable = ['name', 'address', 'map_location_lon', 'map_location_lat', 'username', 'password', 'tele', 'lang', 'city_id'];

    protected static function boot()
    {
        parent::boot();
//        static::deleting( function ( $item ) { // before delete() method call this
//        } );
    }

    public function getPhotoAttribute($value)
    {
        if (!empty($value)) {
            $value = env('APP_URL') . '/gallery/hotels/' . $value;
        }

        return (string)$value;
    }

    public function setPhotoAttribute(UploadedFile $file)
    {
        $fileName = 'hotel-' . time() . '.' . $file->guessExtension();
        $this->attributes['photo'] = $fileName;
    }
}