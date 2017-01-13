<?php

namespace App\Http\Controllers;

use App\Section;
use App\Department;
use App\Article;
use App\User;
use App\ArticleRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sections($id)
    {
    	$department = Department::find($id);
    	$sections = $department->sections;
    	return \Response::json($sections);
    }

    public function articles($id)
    {
        $section = Section::find($id);
        $articles = $section->articles;
        return \Response::json($articles);
    }

    public function getDepartment($id)
    {
    	$department = Department::find($id);
    	if (is_null($department))
        {
            return Redirect::route('departments.index');
        }
    	return \Response::json($department);
    }

    public function getSection($id)
    {
    	$section = Section::find($id);
    	if (is_null($section))
        {
            return Redirect::route('sections.index');
        }
    	return \Response::json($section);
    }

    public function getArticle($id)
    {
        $article = Article::find($id);
        if (is_null($article))
        {
            return Redirect::route('articles.index');
        }
        return \Response::json($article);
    }

    public function getUser($id)
    {
        $user = User::find($id);
        if (is_null($user))
        {
            return Redirect::route('users.index');
        }
        return \Response::json($user);
    }

    public function getArticleRequest($id)
    {
        $articleRequest = ArticleRequest::find($id);
        if (is_null($articleRequest))
        {
            return Redirect::route('requests.index');
        }
        return \Response::json($articleRequest);
    }
}
