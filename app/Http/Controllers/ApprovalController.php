<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ApprovalController extends Controller
{
    /**
     * Display pending events for approval (DKM)
     */
    public function index()
    {
        $pendingEvents = Event::where('status', 'draft')
            ->with('creator')
            ->latest()
            ->paginate(10);

        return view('dkm.approvals', compact('pendingEvents'));
    }

    /**
     * Approve an event
     */
    public function approve($event_id)
    {
        $event = Event::where('event_id', $event_id)->firstOrFail();
        
        // Only approve if status is draft
        if ($event->status === 'draft') {
            $event->status = 'published';
            $event->save();
            
            return redirect()->back()->with('success', 'Event berhasil disetujui!');
        }
        
        return redirect()->back()->with('error', 'Event tidak dapat disetujui!');
    }

    /**
     * Reject an event
     */
    public function reject($event_id)
    {
        $event = Event::where('event_id', $event_id)->firstOrFail();
        
        // Only reject if status is draft
        if ($event->status === 'draft') {
            $event->status = 'cancelled';
            $event->save();
            
            return redirect()->back()->with('success', 'Event berhasil ditolak!');
        }
        
        return redirect()->back()->with('error', 'Event tidak dapat ditolak!');
    }

    /**
     * Display all events with filter (approved/rejected)
     */
    public function allEvents(Request $request)
    {
        $filter = $request->get('filter', 'all'); // all, approved, rejected
        
        $query = Event::with('creator');
        
        if ($filter === 'approved') {
            $query->where('status', 'published');
        } elseif ($filter === 'rejected') {
            $query->where('status', 'cancelled');
        } else {
            // Show both approved and rejected
            $query->whereIn('status', ['published', 'cancelled']);
        }
        
        $events = $query->latest()->paginate(15);
        
        return view('dkm.all-events', compact('events', 'filter'));
    }
}
