<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Quiz extends Model implements HasMedia
{
	use HasMediaTrait;

	protected $table = "quizzes";

    protected $fillable = ["session_id", "title", "content", "grade"];

    public function registerMediaCollections() {
        return $this -> addMediaCollection("attachments");
    }

    public function session() {
    	return $this -> belongsTo(Session::class);
    }

    public function responses() {
    	return $this -> hasMany(QuizResponse::class);
    }
}
