<?php

namespace App;
use Image;
use Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    protected $table = 'credencial';
    //protected $guarded = ['id']; 
    
    protected $fillable = ['id_alumno','foto','firma']; 
    public $timestamps = false;

    public static function setRetrato($retrato)
    {
        if ($retrato) {
            
            $imageName = Str::random(20) . '.jpg';
            $imagen = Image::make($retrato)->encode('jpg', 75);
            $imagen->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('public')->put("$imageName", $imagen->stream());
            
            return $imageName;
        } else {
            return false;
        }

    }

    public static function setFirma($firma)
    {
         if ($firma) {
            
            $imageName = Str::random(20) . '.jpg';
            $imagen = Image::make($firma)->encode('jpg', 75);
            $imagen->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('public')->put("$imageName", $imagen->stream());
            return $imageName;
        } else {
            return false;
        }
    }
}
