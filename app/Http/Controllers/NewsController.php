<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $newsLetter = NewsLetter::all();
        return view('newsletter.newsletter', ['newsletter' => $newsLetter]);
    }
    public function create()
    {
        return view('newsletter.create');
    }

    public function store(Request $request)
    {
        $filename = '';

        $request->validate([
            'caption'=> 'required|string|max:255',
            'image_path' => 'required|image'
        ]);

        if($request->hasFile('image_path')){

            $filename = $request->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' . $request->image_path->extension();

            $request->image_path->move(public_path('/assets/images/'), $filename);
        }

        NewsLetter::create([ 
            'image_path' => $filename,
            'caption' => $request->caption]);
        
        return redirect()->route('newsletter.newsletter')->with('success', 'Nieuwsbrief is succesvol toegoevoegd');
    }

    
    public function edit(NewsLetter $newsletter)
    {
        return view('newsletter.edit', ['newsletter' => $newsletter]);
    }

    
    public function update(NewsLetter $newsLetter, Request $request)
    {
        $data = $request->validate([
            'image_path' => 'nullable|max:255',
            'caption' => 'required|string|max:255',
        
        ]);

        $newsLetter->update($data);

        return redirect()->route('newsletter.newsletter')->with('success', 'Niewsbrief is succesvol geupdated');
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('newsletter.newsletter')->with('success', 'Nieuwsbrief succesvol verwijderd!');
    }
    
}
