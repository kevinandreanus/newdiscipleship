<?php

namespace App\Http\Controllers;

use App\Models\EventNote;
use App\Models\Schedule;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventNotesController extends Controller
{
    public function store(Request $request)
    {
        $notes = new EventNote();
        $notes->schedule_id = $request->schedule_id;
        $notes->user_id = Auth::id();
        $notes->notes = $request->notes;
        $notes->save();

        return json_encode($request->all());
    }

    public function get($id = 4)
    {
        $schedule_note = EventNote::where('schedule_id', $id)->get();

        foreach($schedule_note as $s)
        {
            $s->profile_picture = $s->users->jemaat->profile_picture_url;
            $s->user_name = $s->users->jemaat->nama_lengkap;
            $s->created_at_custom = $this->time_elapsed_string($s->created_at);
        }

        return $schedule_note;
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
