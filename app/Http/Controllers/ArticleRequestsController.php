<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Auth;
use App\Department;
use App\Section;
use App\User;
Use App\ArticleRequest;
use Illuminate\Http\Request;

class ArticleRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleRequests = ArticleRequest::all();
        return view('requests.index', compact('articleRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'article_name' => 'required',
            'usage' => 'required',
            'unit' => 'required',
            'explanation' => 'required',
            'department' => 'required',
            'section' => 'required',

        ]);       

        if (Auth::check()) {
            $articleRequests =  new ArticleRequest($request->all());
            
            $articleRequests->user_id = Auth::id();
            if($request->has('generic')){
                $articleRequests->generic = 1;
            }
            $unit = $request->unit;
            if ($unit == 'otro') {
                $articleRequests->unit = $request->unit_text;
            } else {
               $articleRequests->unit = $unit;
            }
            $articleRequests->department_id = $request->department;
            $articleRequests->section_id = $request->section;
            
            $saved = $articleRequests->save();
        }
        else {
            $request->session()->flash('flash_message', 'Debe ingresar al sistema para realizar una solicitud');
        }       

        if ($saved) {
            $request->session()->flash('flash_message', 'Solicitud creada');
        }
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleRequest $articleRequest)
    {
        //dd($request);
        $articleRequest->sent = ($request->has('sent')) ? 1 : 0 ;
        $articleRequest->created = ($request->has('created')) ? 1 : 0 ;
        if ($request->has('cod_art')) {
            $articleRequest->cod_art = $request->cod_art;
        } 

        if ($request->has('des_art')) {
            $articleRequest->des_art = $request->des_art;
        } 

        $saved = $articleRequest->update();

        if ($saved) {
            $request->session()->flash('flash_message', 'Solicitud editada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo editar la solicitud.');
        }

        return redirect('request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ArticleRequest $articleRequest)
    {
        //dd($request);
        $deleted = $articleRequest->delete();

        if ($deleted) {
            $request->session()->flash('flash_message', 'Solicitud eliminada.');
        }
        if (!$deleted) {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar la solicitud.');
        }

       return redirect('request');
    }
}
