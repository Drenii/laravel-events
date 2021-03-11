<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function add_event()
    {
        return view('add_event');

    }

    public function insert_event(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|file|image'
        ]);

        $event = new Event();
        $event->title = filter_var($request->input('title'), FILTER_SANITIZE_STRING);
        $event->description = filter_var($request->input('description'), FILTER_SANITIZE_STRING);
        $event->date = $request->input('date');

        if ($request->file('image') != null) {
            $path = $request->file('image')->store('images');
            $event->image = $path;
        }

        $event->user_id=Auth::id();
        if ($event->save()) {
//            $data = [
//                'title' => $event->title,
//                'date' => $event->date,
//                'description' => $event->description,
//            ];
//
//            Mail::send(['html'=>'konfirmimi'],$data,function ($message){
//               $message->to(Auth::user()->enail,Auth::user()->name)
//               ->subject('Konfirmimi per event');
//               $message->form(env('MAIL_FROM_ADDRESS',env('MAIL_FROM_NAME')));
//            });
            return view('report', ['text' => 'Event created successfully']);
        } else {
            return view('report', ['text' => 'Database error']);

        }
    }

    public function events(){
        $data['events'] = Event::orderBy('date', 'desc')->get();
        return view('events',$data);
    }
}
