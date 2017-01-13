<?php

namespace App\Http\Controllers;

use DB;
use App\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    //
    public function index()
    {
    	$departments = Department::all();

    	return view('departments.index', compact('departments'));
    }

    public function show(Department $department)
    {
    	return view('departments.show', compact('department'));
    }
    	
    public function add()
    {
        return view('departments.add');
    }
     
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
            'code' => 'required|min:2|max:2|alpha',
            'name' => 'required|max:255'
        ]);
        
        $department = new Department($request->all());
        $saved = $department->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Departamento creado.');
        }
        if ($saved = false) {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Departamento.');
        }
        
        return back();
    }

    public function edit(Department $department)
    {
        
    }

    public function update(Request $request, Department $department)
    {
        $saved = $department->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Departamento modificado.');
        }
        if (!$saved) {
            $request->session()->flash('flash_message_not', 'No se pudo modificar el Departamento.');
        }

        return redirect('/department');
    }   

    public function destroy(Request $request,Department $department)
    {
        $deleted = $department->delete();

        if ($deleted) {
            $request->session()->flash('flash_message', 'Departamento eliminado.');
        }
        if (!$deleted){
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el Departamento.');   
        }

        return redirect('/department');
    }
                            
}
