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
        $data = $request->validate([
            'caption'=> 'required|string|max:255',
            'image_path' => 'required|string|max:255'
        ]);

        NewsLetter::create($data);
        
        return redirect()->route('newsletter.newsletter')->with('success', 'Nieuwsbrief is succesvol toegoevoegd');
    }

    
    public function edit(NewsLetter $newsLetter)
    {
        return view('newsletter.edit', ['newsletter' => $newsLetter]);
    }

    
    public function update(NewsLetter $newsLetter, Request $request)
    {
        $data = $request->validate([
            'image_path' => 'nullable|file|max:255',
            'caption' => 'required|string|max:255',
        
        ]);

        $newsLetter->update($data);

        return redirect()->route('newsletter.newsletter')->with('success', 'Niewsbrief is succesvol geupdated');
    }

    public function destroy(NewsLetter $newsLetter)
    {
        $newsLetter->delete();

        return redirect()->route('newsletter.newsletter')->with('success', 'Niewsbrief is succesvol verwijderd');
    }
}
