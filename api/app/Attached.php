<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attached extends Model
{
    protected $table = 'attached';
    public $timestamps = false;
    protected $fillable = ['path','id_pago','created_at','updated_at']; 

    public static function setBaucher($baucher)
    {
        if ($baucher) {
            
            $imageName = Str::random(20) . '.jpg';
            $imagen = Image::make($baucher)->encode('jpg', 75);
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
