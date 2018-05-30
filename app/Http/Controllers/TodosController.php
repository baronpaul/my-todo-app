<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;

class TodosController extends Controller
{
    
    public function index()
    {
        return Todo::orderBy('id','desc')->get();
    }

    
    
    public function show($id)
    {
        $todo = Todo::find($id);
        return $todo;   
    }


    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required'
        ]);

        $todo = Todo::create([
            'title' => $request->title,
            'completed' => $request->completed
        ]);
        
        return response(Todo::orderBy('id','desc')->get(), 200);
    }


    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'completed' => 'required'
        ]);

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->completed = $request->completed;
        $todo->save();
        return response(todo::orderBy('id','desc')->get(), 200);
    }

    
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return response(todo::orderBy('id','desc')->get(), 200);
    }
}
