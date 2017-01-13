<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = ['code', 'name'];
    
    public function sections()
    {
    	return $this->hasMany(Section::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function articleRequests()
    {
        return $this->hasMany(ArticleRequest::class);
    }
      
    public function path()
    {
    	return '/department/' . $this->id;
    }  

    public function findId($deparment_code)
    {
        $department_id = Department::where('code', '=', $deparment_code)->first();
        return $department_id->id;
    }

    public function findCode($department_id)
    {
        $department = Department::find($department_id);
        return $deparment->code;
    }
        
                     	
}
