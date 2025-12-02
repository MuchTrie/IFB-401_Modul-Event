<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index');
    }

    public function create()
    {
        return view('events.create');
    }

    public function createRoutine()
    {
        return view('events.create-routine');
    }

    public function show($id)
    {
        return view('events.show', ['eventId' => $id]);
    }

    public function attendance($id)
    {
        return view('events.attendance', ['eventId' => $id]);
    }
}
