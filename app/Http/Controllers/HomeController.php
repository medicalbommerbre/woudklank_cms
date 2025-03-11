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
        $home = HomePage::orderBy('order', 'asc')->get();
        return view('home.create', ['home' => $home]);
    }
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|string',
            'button' => 'nullable|string',
            'button_alt' => 'nullable|string',
            'colour_text' => 'nullable|string',
            'colour_background' => 'nullable|string',
            'colour_button' => 'nullable|string',
        ]);

        if(empty($data['order'])){
            $nextNumber = HomePage::max('order') +1;
            $data['order'] = $nextNumber;
        }
 
        if (HomePage::where('order', $data['order'])->exists()) {
            $targetPriority = $data['order'];

            HomePage::where('order', '>=', $targetPriority)
                    ->increment('order');
        } 
        
        HomePage::create([

            'title' => $request->title,
            'content' => $request->content,
            'order' =>$request->order,
            'status' => 'Inactief',
            'button' => $request->button,
            'button_alt' =>$request->button_alt,
            'colour_text' => $request->colour_text,
            'colour_background' => $request->colour_background,
            'colour_button' => $request->colour_button
        ]);

        return redirect()->route('home.home')->with('success', 'Home item is successfully added');
    }
    
    
    public function edit(HomePage $home)
    {
        $home2 = HomePage::orderBy('order', 'asc')->get();
        return view('home.edit', ['home' => $home],['home2' => $home2]);
    }

    
    public function update(HomePage $home, Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'nullable|string',
            'order' => 'nullable|integer',
            'button' => 'nullable|string',
            'button_alt' => 'nullable|string',
            'colour_text' => 'nullable|string',
            'colour_background' => 'nullable|string',
            'colour_button' => 'nullable|string',
        ]);
        if(empty($data['order'])){
            $nextNumber = HomePage::max('order') +1;
            $data['order'] = $nextNumber;
        }
 
        if (HomePage::where('order', $data['order'])->exists()) {
            $targetPriority = $data['order'];

            HomePage::where('order', '>=', $targetPriority)
                    ->increment('order');
        } 
        
    
        $home->update([
            'title' => $request->title,
            'content' => $request->content,
            'order' =>$request->order,
            'status' => 'Inactief',
            'button' => $request->button,
            'button_alt' =>$request->button_alt,
            'colour_text' => $request->colour_text,
            'colour_background' => $request->colour_background,
            'colour_button' => $request->colour_button
            ]
        );

    
        return redirect()->route('home.home')->with('success', 'Homepage item is succesvol geüpdatet');
    }
    public function preview(){
        $home = HomePage::orderBy('order', 'asc')->get();
        return view('home.preview', ['home' => $home]);
    }
    public function cancel(){
        return redirect()->route('home.home')->with('success', 'Gecanceld, maar niet verwijderd');
    }


    public function confirm(){
        HomePage::where('status', 'Inactief')
        ->update(['status' => 'Actief']);


        return redirect()->route('home.home')->with('success', 'Website is succesvol geupdate');
    }
    

  public function destroy(HomePage $home)
{
    $deletedPriority = $home->order;
    $home->delete();

    HomePage::where('order', '>', $deletedPriority)
            ->decrement('order');

    return redirect()->route('home.home')->with('success', 'Homepage item is succesvol verwijderd');
}

}

    


