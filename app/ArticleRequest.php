<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleRequest extends Model
{
    //

    protected $fillable = ['user_id', 'article_name', 'usage', 'generic', 'unit', 'explanation', 'department_id', 'section_id', 'created', 'sent', 'cod_art', 'des_art'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

   public function department()
   {
   	return $this->belongsTo(Department::class, 'department_id', 'id');
   }

   public function section()
   {
   	return $this->belongsTo(Section::class, 'section_id', 'id');
   }	
   	
}
