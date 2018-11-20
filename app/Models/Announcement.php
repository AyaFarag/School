<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Announcement extends Model implements HasMedia
{
	use HasMediaTrait;	

    protected $fillable = ["title", "content"];

    public function registerMediaCollections() {
        return $this -> addMediaCollection("attachments");
    }

    public function semesterSession() {
    	return $this -> belongsTo(SemesterSession::class);
    }
}
