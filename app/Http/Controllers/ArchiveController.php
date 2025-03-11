<?php

namespace App\Http\Controllers;
use App\Models\ArchivedEvent;  

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $events = ArchivedEvent::all();
   
        return view('archive.archive', ['event' => $events]);
    }
    public function foto($id)
    {
        $events = ArchivedEvent::where('id','=',$id);
   
        return view('archive.showfoto', ['id' => $id]);
    }
    public function edit(ArchivedEvent $event)
    {
        return view('archive.edit', ['event' => $event]);
    }

    
    public function update(ArchivedEvent $event, Request $request)
    {
        $data = $request->all();
        $data['event_time'] = substr($data['event_time'], 0, 5); // Truncate to HH:MM format

        $data = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'location' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:255',
        ]);
        

        $event->update($data);

        return redirect()->route('archive.archive')->with('success', 'Event is succesvol geupdated');
    }
    public function destroy(ArchivedEvent $id)
    {
        $id->delete();
    
        return redirect()->route('archive.archive')->with('success', 'Event is succesvol verwijderd');
    }
    
}
