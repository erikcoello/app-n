<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Str;
use Illuminate\Support\Facades\Storage;

class Official extends Model
{
    protected $table = 'official';
    public $timestamps = false;
    protected $fillable = ['id_alumno','bachiller','curp','actaNac']; 
    //protected $guarded = ['id'];

    
    public static function docOfficiales($certBachiller, $actual = false)
    {
        if ($certBachiller) {
            if ($actual) {
                Storage::disk('public')->delete("imagenes/official/$actual");
            }
            $imageName = Str::random(20) . '.jpg';
            $imagen = Image::make($certBachiller)->encode('jpg', 75);
            $imagen->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('public')->put("imagenes/official/$imageName", $imagen->stream());
            return $imageName;
        } else {
            return false;
        }

    }


    public static function docCurp($curp, $actual = false)
    {
         if ($curp) {
            if ($actual) {
                Storage::disk('public')->delete("imagenes/official/$actual");
            }
            $imageName = Str::random(20) . '.jpg';
            $imagen = Image::make($curp)->encode('jpg', 75);
            $imagen->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('public')->put("imagenes/official/$imageName", $imagen->stream());
            return $imageName;
        } else {
            return false;
        }
    }
}/////class