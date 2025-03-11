<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryPhoto;
class HistoryPhotoController extends Controller
{
    public function index($history){

        $data = HistoryPhoto::where('history_id', $history)->get();

        return view('historyfoto.foto',['history'=> $data ]);


    }
    public function create()
    {
       
        return view('historyfoto.addfoto');
    }
    
    public function store(Request $request)
    {
        $filename = '';

        $request->validate([
            'img' => 'required|image',
            'caption' => 'required|string|max:255',
            'history_id' => 'required|integer',
        ]);

        if($request->hasFile('img')){

            $filename = $request->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' . $request->img->extension();

            $request->img->move(public_path('/assets/images/'), $filename);
        }
        
        HistoryPhoto::create([
            'photo_path' => $filename,
            'caption' => $request->caption,
            'history_id' => $request->history_id
        ]);

        return back()->with('success', 'Foto is succesvol geupload');
    }
    public function edit(HistoryPhoto $history)
    {
        
        return view('historyfoto.edit',['history'=>$history]);
    }
    

    public function update(HistoryPhoto $history, Request $request)
    {
        $data = $request->validate([
            'img' => 'nullable|image',
            'caption' => 'nullable|string|max:255',
            'history_id' => 'required|integer',
        ]);
    
   
        if ($request->hasFile('img')) {
            $filename = 'assets/images/' . time() . '.' . $request->img->extension();
            $request->img->move(public_path('assets/images/'), basename($filename));
            $data['photo_path'] = $filename; 
        }
    
        $history->update($data);
    
        return back()->with('success', 'Item is succesvol geupdated');
    }
    



    
    public function destroy(HistoryPhoto $history)
    {
        $history->delete();

        return back()->with('success', 'History item is succesvol verwijderd');
    }


}
