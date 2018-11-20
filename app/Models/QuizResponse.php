<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class QuizResponse extends Model implements HasMedia
{
	use HasMediaTrait;

    protected $fillable = ["session_id", "title", "content", "grade"];

    public function registerMediaCollections() {
        return $this -> addMediaCollection("attachments");
    }

    public function quiz() {
    	return $this -> belongsTo(Quiz::class);
    }

    public function student() {
        return $this -> belongsTo(Student::class);
    }
}
