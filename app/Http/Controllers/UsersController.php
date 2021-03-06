<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function add()
    {
        return view('users.add');
    }

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
            'name' => 'required|max:255',
            'password' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric'
        ]);
        
        $user = new User($request->all());

        if($request->has('isAdmin')){
            $user->isAdmin = 1;
        }
        $user->password = bcrypt($request->password);

        $saved = $user->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Usuario creado.');
        }
        if (!$saved) {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Usuario.');
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
    public function update(Request $request, User $user)
    {
        //dd($request);
        $user->isAdmin = ($request->has('isAdmin')) ? 1 : 0 ;
        $saved = $user->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Usuario editado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo editar el Usuario.');
        }

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        //dd($user);

        $authenticated = Auth::id();
        if ($authenticated != $user->id) {
            $deleted = $user->delete();

            if ($deleted) {
                $request->session()->flash('flash_message', 'Usuario eliminado.');
            }
            else {
                $request->session()->flash('flash_message_not', 'No se pudo eliminar el usuario.');
            }
        } 
        else {
            $request->session()->flash('flash_message_not', 'No se puede eliminar a sí mismo.');
        }
        
        return redirect('user');

    }
}
