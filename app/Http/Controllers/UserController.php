<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::select("*");
  
        if ($request->has('view_deleted')) {
            $users = $users->onlyTrashed();
        }
  
        $users = $users->paginate(8);
          
        return view('users', compact('users'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($id)
    {
        User::find($id)->delete();
  
        return back();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id)->restore();
  
        return back();
    }  
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function restoreAll()
    {
        User::onlyTrashed()->restore();
  
        return back();
    }
}