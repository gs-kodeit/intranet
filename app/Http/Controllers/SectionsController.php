<?php

namespace App\Http\Controllers;

use DB;
USE Input;
use App\Section;
use App\Department;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    //
    public function index()
    {
    	$sections = Section::all();
        $departments = Department::all();
        return view('sections.index', compact('sections','departments'));
    }

    public function add()
    {
        $departments = Department::orderBy('name', 'asc')->get();

    	return view('sections.add', compact('departments'));
    }
    	
    public function store(Request $request)
    {
        //dd($request);
    	$this->validate($request, [
            'department' => 'required',
    		'code' => 'required|min:2|max:2|alpha',
    		'name' => 'required|max:255'
    	]);
        
        $department_id = Input::get('department');
        $department = Department::find($department_id);
        
    	$section = new Section($request->all());
    	$section->department_id = $department_id;
        $section->department_code = $department->code;
    	$saved = $section->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Sección creada.');
        }
        if (!$saved) {
            $request->session()->flash('flash_message_not', 'No se pudo crear la sección.');
        }
        
        return back();
    }

    public function edit(Section $section)
    {
        
    }


    public function update(Request $request, Section $section)
    {
        //dd($request);

        $saved = $section->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Sección editada');
        }
        if (!$saved) {
            $request->session()->flash('flash_message_not', 'No se pudo editar la Sección.');
        }

        return redirect('section');
    }

    public function destroy(Request $request, Section $section)
    {
        //dd($section);
       $deleted = $section->delete();

        if ($deleted) {
            $request->session()->flash('flash_message', 'Sección eliminada.');
        }
        if (!$deleted) {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar la Sección.');
        }

       return redirect('section');
    }   
    	
}
