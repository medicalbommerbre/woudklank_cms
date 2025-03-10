<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\ArchivedEvent;  
use Illuminate\Http\Request;
use Psy\Readline\Hoa\EventBucket;


class EventController extends Controller
{
    // Display all events
    public function index()
    {
        $events = Events::all();
        return view('event.events', ['events' => $events]);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $filename = '';
        $data['event_time'] = date('H:i', strtotime($request->input('event_time')));


        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'location' => 'nullable|string|max:255',
            'image_path' => 'nullable|image',
        ]);   
        
        if($request->hasFile('image_path')){

            $filename = $request->getSchemeAndHttpHost() . '/assets/images/' . time() . '.' . $request->image_path->extension();

            $request->image_path->move(public_path('/assets/images/'), $filename);
        }



        Events::create([
            'event_title' => $request->event_title,
            'event_description' => $request->event_description,
            'event_date' =>$request->event_date,
            'event_time' =>$request->event_time,
            'location' =>$request->location,
            'image_path' =>$filename ,

        ]);
        
        return redirect()->route('event.events')->with('success', 'Event is succesvol aangemaakt');
    }

    
    public function edit(Events $event)
    {
        return view('event.edit', ['event' => $event]);
    }

    
    public function update(Events $event, Request $request)
    {
        $data = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'location' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:255',
        ]);

        $event->update($data);

        return redirect()->route('event.events')->with('success', 'Event is succesvol geupdated');
    }

    public function destroy(Events $event)
    {
        $event->delete();

        return redirect()->route('event.events')->with('success', 'Event is succesvol verwijderd');
    }
    public function archive(Events $event) 
    {
       
        if ($event->event_date < now()) {
            
            ArchivedEvent::create([
                'event_title' => $event->event_title,
                'event_description' => $event->event_description,
                'event_date' => $event->event_date,
                'event_time' => $event->event_time,
                'location' => $event->location,
                'image_path' => $event->image_path,
            ]);
    
            $event->delete();
    
            return redirect()->route('event.events')->with('success', 'Event succesvol gearchiveerd');
        }
    
        return redirect()->route('event.events')->with('error', 'Event kan nog niet worden gearchiveerd');
    }
    
}

