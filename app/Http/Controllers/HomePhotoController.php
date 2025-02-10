<?php

namespace App\Http\Controllers;
use App\Models\HomePhotos;
use Illuminate\Http\Request;

class HomePhotoController extends Controller
{

    public function index($home) {

        $homePhotos = HomePhotos::where('home_id', $home)->get();
      
    
        return view('homefoto.foto', [
            'home' => $homePhotos    
        ]);
    }
    
    public function create()
    {
       
        return view('homefoto.addfoto');
    }
    

    

    public function store(Request $request)
    {
        $filename = '';

        $request->validate([
            'img' => 'required|image',
            'caption' => 'required|string|max:255',
            'home_id' => 'required|integer',
        ]);

        if($request->hasFile('img')){

            $filename = $request->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' . $request->img->extension();

            $request->img->move(public_path('/assets/images/'), $filename);
        }
        
        HomePhotos::create([
            'photo_path' => $filename,
            'caption' => $request->caption,
            'home_id' => $request->home_id
        ]);

        return back()->with('success', 'Foto is succesvol geupload');
    }
    public function edit(HomePhotos $photo)
    {
        return view('homefoto.edit', ['photo' => $photo]);
    }
    
    

    public function update(HomePhotos $home, Request $request){
        $data =    $request->validate([
            'img' => 'nullable|image',
            'caption' => 'nullable|string|max:255',
            'home_id' => 'required|integer',
        ]);

        if($request->hasFile('img')){

            $filename = $request->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' . $request->img->extension();

            $request->img->move(public_path('/assets/images/'), $filename);
        }
        $home->update($data);

        return back()->with('success', 'Item is succesvol geupdated');
    }



    
    public function destroy(HomePhotos $home)
    {
        $home->delete();

        return back()->with('success', 'Homepage item is succesvol verwijderd');
    }
    
    
}
