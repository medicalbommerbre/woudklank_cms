<?php

namespace App\Http\Controllers;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $home = HomePage::orderBy('order', 'asc')->get();
        return view('home.home', ['home' => $home]);
        
    }
    public function create()
    {
        return view('home.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string',
            'foto_path' => 'nullable|string',
            'content' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if(empty($data['priority'])){
            $nextNumber = HomePage::max('order') +1;
            $data['order'] = $nextNumber;
        }
    
       
        HomePage::where('order', '>=', $data['order'])->increment('order');
        HomePage::create($data);
    
        return redirect()->route('home.home')->with('success', 'Home item is successfully added');
    }
    
    
    public function edit(HomePage $home)
    {
        
        return view('home.edit', ['home' => $home]);
    }

    
    public function update(HomePage $home, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string',
            'foto_path' => 'nullable|string',
            'content' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);
    
        $home->update($data);
    
        return redirect()->route('home.home')->with('success', 'Homepage item is succesvol geüpdatet');
    }
    

    public function destroy(HomePage $home)
    {
        $home->delete();

        return redirect()->route('home.home')->with('success', 'Homepage item is succesvol verwijderd');
    }
}

    


