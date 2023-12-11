<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event as Event;
use App\Models\Speaker as Speaker;
use App\Models\Sponsor as Sponsor;
use App\Models\Partner as Partner;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $event = new Event;

        $event->name = $request->only('name')['name'];
        $event->description = $request->only('description')['description'];
        $event->location = $request->only('location')['location'];
        $event->event_date = $request->only('date')['date'];
        $event->event_time = $request->only('time')['time'];

        $event->save();

        $sponsorsString = $request->input('sponsors');
        $sponsors = explode(',', $sponsorsString);

        $speakersString = $request->input('speakers');
        $speakers = explode(',', $speakersString);

        $partnersString = $request->input('partners');
        $partners = explode(',', $partnersString);

        foreach ($sponsors as $sponsor) {
            $sponsorModel = new Sponsor;
            $sponsorModel->name = $sponsor;
            $sponsorModel->event_id = $event->getId(); // Access the id directly from the saved event
            $sponsorModel->save();
        }

        foreach ($speakers as $speaker) {
            $speakerModel = new Speaker;
            $speakerModel->name = $speaker;
            $speakerModel->event_id = $event->getId(); // Access the id directly from the saved event
            $speakerModel->save();
        }

        foreach ($partners as $partner) {
            $partnerModel = new Partner;
            $partnerModel->name = $partner;
            $partnerModel->event_id = $event->getId(); // Access the id directly from the saved event
            $partnerModel->save();
        }

        return redirect('/adminDashboard')->with('message', 'Successfully created a new event');
    }

    public function deleteAll() {
        Event::deleteAllEvents();
        return redirect()->back()->with('message', 'Successfully deleted all events');
    }

    public function deleteEvent($var1) 
    {
        Event::deleteEvent($var1);
        return redirect()->back()->with('message', 'Successfully deleted the event');
    }

    public function editEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404);
        }
        return view('admin/editEvent', ['event' => $event]);
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            abort(404);
        }
        $event->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
        ]);

        return redirect()->route('seeEvents')->with('message', 'Event updated successfully.');
    }
}
