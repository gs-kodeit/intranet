<?php

namespace App\Http\Controllers;

use DB;
use Input;
use App\Section;
use App\Department;
use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //

    //protected $layout = 'layout';

    public function index()
    {
    	$articles = Article::orderBy('code', 'asc')->get();
        $sections = Section::all();
        $departments = Department::all();
    	return view('articles.index', compact('articles','sections','departments'));
    }

	public function add()
    {
    	$departments = Department::orderBy('name', 'asc')->get();
    	//$sections = Section::orderBy('name', 'asc')->get();
    	return view('articles.add', compact('departments'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'department' => 'required',
            'section' => 'required',
            'code' => 'required|min:8|max:8|alpha_num',
            'name' => 'required|max:255'
        ]);

        $article = new Article($request->all());
        $article->department_id = $request->department;
        $article->section_id = $request->section;

        $saved = $article->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Artículo creado.');
        }
        if (!$saved) {
            $request->session()->flash('flash_message_not', 'No se pudo crear el artículo.');
        }
        
        return back();
    }
    
    public function update(Request $request, Article $article)
    {
        //dd($request);
        $article->name = $request->name;
        $article->department_id = $request->department;
        $article->section_id = $request->section;
        $saved = $article->update();

        if ($saved) {
            $request->session()->flash('flash_message', 'Artículo editado');
        }
        if (!$saved) {
            $request->session()->flash('flash_message_not', 'No se pudo editar el artículo.');
        }

        return redirect('/article');
    }

    public function destroy(Request $request, Article $article)
    {
        //dd($section);
        $deleted = $article->delete();

        if ($deleted) {
            $request->session()->flash('flash_message', 'Artículo eliminado.');
        }
        if (!$deleted) {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el artículo.');
        }

       return redirect('/article');
    }    

}
