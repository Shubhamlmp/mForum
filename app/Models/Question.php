<?php

namespace App\Models;

// use Cviebrock\EloquentSluggable\Sluggable as EloquentSluggableSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Question extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'add_question',
        'slug',
    ];

    protected $primaryKey = 'que_id';
    protected $guarded = [];

    public static function getTotalCount($id){
        return Question::where('que_id', $id)
                        ->pluck('views')
                        ->first();
    }

    public function sluggable():array
    {
        return[
            'slug' =>[
                'source' => 'add_question'
            ]
            ];
    }

}