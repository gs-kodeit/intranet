<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['code', 'name', 'department_code', 'department_id'];
    
    public function department()
    {
    	//return $this->belongsTo(Department::class, 'department_code', 'code');
    	return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
    
    public function articleRequests()
    {
        return $this->hasMany(ArticleRequest::class);
    }	
    	
}
