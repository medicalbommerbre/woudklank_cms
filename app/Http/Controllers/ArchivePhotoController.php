<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModel;
use App\Models\ArchivedEvent;
class ArchivePhotoController extends Controller
{

    public function foto($id){
        $data = PhotoModel::where('archived_event_id', $id)->get();
        return view('archive.showfoto', ['id' => $data]);
    }
    public function create()
    {
        return view('archive.addfoto');
    }

    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|array|min:1', 
            'img.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'caption' => 'nullable|array', 
            'caption.*' => 'nullable|string|max:255', 
            'archived_event_id' => 'required|integer', 
        ]);
    
        foreach ($request->file('img') as $key => $file) {
    
            $filename = time() . '_' . $key . '.' . $file->extension();
            
            $file->move(public_path('/assets/images/'), $filename);
    
            PhotoModel::create([
                'image_path' => $request->getSchemeAndHttpHost() . '/assets/images/' . $filename,
                'caption' => isset($request->caption[$key]) ? $request->caption[$key] : null, 
                'archived_event_id' => $request->archived_event_id, 
            ]);
        }
    
        return back()->with('success', 'Foto\'s zijn succesvol geüpload');
    }
    
    public function edit(PhotoModel $id)
    {

        return view('archive.fotoedit',['id'=>$id]);
    }
    
    public function update(PhotoModel $id, Request $request)
    {
        $data = $request->validate([
            'img' => 'nullable',
            'caption' => 'nullable|string|max:255',
            'archived_event_id' => 'required|integer',
        ]);
    
        if($request->hasFile('img')){

            $filename = $request->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' . $request->img->extension();

            $request->img->move(public_path('/assets/images/'), $filename);
        }
    
        $id->update($data);
    
        return back()->with('success', 'Item is succesvol geupdated');
    }

    public function destroy(PhotoModel $id)
    {
        $id->delete();
        return back()->with('success', 'Foto is verwijderd');
    }


}
