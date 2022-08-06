<?php

namespace App\Http\Controllers;

use App\Models\EventAttendance;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    public function index($id){
        $id = Crypt::decryptString($id);

        return view('schedule');
    }

    public function store(Request $request){
        
        $user_id = Crypt::decryptString($request->user_id);
        
        $schedule = new Schedule();

        // If Online
        if($request->offline_or_online == 'online'){

            // $datetimestr = strtotime($request->datetime);

            $validator = Validator::make($request->all(), [
                'event_title' => ['required'],
                'datetime' => ['required'],
                'end_datetime' => ['required'],
                'pic' => ['required'],
                'generated_meet_link' => ['required_without:manual_meet_link'],
                'manual_meet_link' => ['required_without:generated_meet_link'],
                'guest' => ['required'],
            ]);

            if($validator->fails()){
                return [
                    'error' => $validator->messages()
                ];
            }

            // if($datetimestr < strtotime('now + 1 hours')){
            //     return [
            //         'datetimeerror' => 'Choose at least +1 hour from now.',
            //     ];
            // }

            $schedule->event_id = $request->event_id;
            $schedule->title = $request->event_title;
            $schedule->datetime = $request->datetime;
            $schedule->end_datetime = $request->end_datetime;
            $schedule->pic = $request->pic;
            $schedule->meet_link = $request->generated_meet_link;
            $schedule->alternative_meet_link = $request->manual_meet_link;

            $schedule->description = $request->description;
            $schedule->created_by = $user_id;
            $schedule->modified_by = $user_id;
            $schedule->save();

            $guest_arr = explode(',', $request->guest);
            
            foreach($guest_arr as $each){
                if($each == $schedule->pic){
                    continue;
                }
                $schedule_detail = new ScheduleDetail;
                $schedule_detail->parent_id = $schedule->id;
                $schedule_detail->user_id = $each;
                $schedule_detail->created_by = $user_id;
                $schedule_detail->modified_by = $user_id;
                $schedule_detail->save();
            }

            return 'Success';
        }

        // If Offline
        if($request->offline_or_online == 'offline'){

            $validator = Validator::make($request->all(), [
                'event_title' => ['required'],
                'datetime' => ['required'],
                'end_datetime' => ['required'],
                'pic' => ['required'],
                'location_address' => ['required'],
                'guest' => ['required'],
            ]);

            if($validator->fails()){
                return [
                    'error' => $validator->messages()
                ];
            }

            $schedule->event_id = $request->event_id;
            $schedule->title = $request->event_title;
            $schedule->datetime = $request->datetime;
            $schedule->end_datetime = $request->end_datetime;
            $schedule->pic = $request->pic;
            $schedule->address_address = $request->location_address;
            $schedule->address_description = $request->address_description;
            $schedule->address_link = 'https://www.google.com/maps?q='.$request->location_address;
            $schedule->description = $request->description;
            $schedule->created_by = $user_id;
            $schedule->modified_by = $user_id;
            $schedule->save();

            $guest_arr = explode(',', $request->guest);
            
            foreach($guest_arr as $each){
                if($each == $schedule->pic){
                    continue;
                }
                $schedule_detail = new ScheduleDetail;
                $schedule_detail->parent_id = $schedule->id;
                $schedule_detail->user_id = $each;
                $schedule_detail->created_by = $user_id;
                $schedule_detail->modified_by = $user_id;
                $schedule_detail->save();
            }

            return 'Success';
        }

    }

    public function scheduleData($id){
        $id = Crypt::decryptString($id);

        $user = User::find($id);

        $query = DB::select("SELECT DISTINCT s.title AS title, s.datetime AS start, s.end_datetime AS end, s.id AS id 
        FROM schedules s 
        INNER JOIN schedule_details sd ON s.id = sd.parent_id 
        WHERE s.created_by = $user->id OR s.pic = $user->id OR sd.user_id = $user->id");

        return $query;
    }

    public function scheduleEachData($id){
        $schedule = Schedule::find($id);

        $schedule->datetime = date('d M Y h:i A', strtotime($schedule->datetime));
        $schedule->end_datetime = date('d M Y h:i A', strtotime($schedule->end_datetime));

        $schedule->pic_name = $schedule->getPIC->name;
        
        $schedule->guest_name = '';

        foreach($schedule->details as $key => $d)
        {
            $guest_name = User::find($d->user_id);
            if ($key === array_key_last($schedule->details->toArray())) {
                $schedule->guest_name = $schedule->guest_name . $guest_name->name;
            }else{
                $schedule->guest_name = $schedule->guest_name . $guest_name->name . ', ';
            }
        }

        // Check if the Authenticated user is already check in or not
        $attendance = EventAttendance::where(['schedule_id' => $id, 'user_id' => Auth::id()])->first();
        $date_end = new DateTime($schedule->end_datetime);
        $date_now = new DateTime();

        if($attendance){
            $schedule->is_attend = 1;
        }else if($date_end <= $date_now){
            $schedule->is_attend = 2;
        }
        else{
            $schedule->is_attend = 0;
        }


        return $schedule;
    }

    public function check_in($id){
        $schedule = Schedule::find($id);

        // Check the time validation for check in
        $date_start_temp = date("Y-m-d H:i:s",strtotime($schedule->datetime." -30 minutes"));
        $date_start = new DateTime($date_start_temp);
        $date_end = new DateTime($schedule->end_datetime);
        $date_now = new DateTime();
        
        if($date_start <= $date_now && $date_now <= $date_end) {
            // Check if the authenticated user is related with schedule or not
            $user_arr = [];

            array_push($user_arr, $schedule->pic);
            foreach($schedule->details as $d)
            {
                array_push($user_arr, $d->user_id);
            }

            $found = array_search(Auth::id(), $user_arr);
            
            if($found !== false){
                // Insert to Event Attendance Table
                $attendance = new EventAttendance();
                $attendance->schedule_id = $id;
                $attendance->user_id = Auth::id();
                $attendance->save();

                return redirect()->back()->with('success', 'Successfully Check in!');
            }else{
                return abort(404);
            }
        }else{
            return redirect()->back()->with('failed', "Can't Check in right now!");
        }

        
    }

}
