<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventAttendanceController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_at', 'desc')->get();

        return view('events.attendance-list', compact('events'));
    }

    public function show($event_id)
    {
        $event = Event::findOrFail($event_id);

        return view('events.attendance-detail', compact('event'));
    }
}
