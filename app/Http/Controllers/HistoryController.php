<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function index(){
        $history = History::all();
        return view('history.history', ['history' => $history]);
    }

    public function create(){
        return view('history.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=> 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        History::create($data);
        
        return redirect()->route('history.history')->with('success', 'Item is succesvol toegoevoegd');
    }
    
    public function edit(History $history)
    {
        return view('history.edit', ['history' => $history]);
    }

    public function update(History $history, Request $request)
    {
        $data = $request->validate([
            'title'=> 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $history->update($data);

        return redirect()->route('history.history')->with('success', 'Geschiedenis item is succesvol geupdated');
    }

    public function destroy(History $history)
    {
        $history->delete();
    }
}
