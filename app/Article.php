<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //

    protected $fillable = ['code', 'name', 'section_code', 'department_code'];

    public function section()
    {
    	return $this->belongsTo(Section::class);
    }

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }
    	
    	
}
