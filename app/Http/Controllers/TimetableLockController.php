<?php

namespace App\Http\Controllers;

use App\Models\Dictionaries;
use App\Models\DictinaryValue;
use App\Models\TimetableLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TimetableLockController extends Controller
{
    public function getAllLock(Request $request){
        $lockTimetable = TimetableLock::query()->whereRaw('date(tt_lock_date)>=date(NOW())')->get();
        return response()->json($lockTimetable);
    }
    public function AddInterval(Request $request)
    {
        $timeInfo = ['10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00'];
        if($request->allday==1){
            DB::table('timetable_locks')->insert(
                ['tt_lock_date'=>$request->date, 'tt_lock_object_id'=>$request->object,'tt_lock_allday'=>1,'tt_lock_comments'=>$request->comments]
            );
        } else {
            for($i=1;$i<9;$i++){
               if($request['interval'.$i]==1){
                DB::table('timetable_locks')->insert(
                    ['tt_lock_date'=>$request->date, 'tt_lock_object_id'=>$request->object,'tt_lock_allday'=>0,
                        'tt_lock_comments'=>$request->comments,'tt_lock_time_begin'=>$timeInfo[$i-1]]
                );
                }
            }
        }
        return response()->json($request);
    }
    public function DateIslock(Request $request, $objectId, $dateInfo){
        $dateIsLock = 0;
        $lockTimetable = TimetableLock::query()
                ->whereRaw('(date(tt_lock_date)=date("'.$dateInfo.'"))and((tt_lock_object_id=0)or(tt_lock_object_id='.$objectId.'))and(tt_lock_allday=1)')
                ->first();
        if(isset($lockTimetable)){
           if($lockTimetable->tt_lock_allday==1){
               $dateIsLock = 1;
           }
        }
        if ($dateIsLock == 1) {
            return response()->json(['success'=>true, 'info'=>1]);
        } else {
            $lockInfo = DB::table('timetable_locks')
            ->selectRaw('COUNT(DISTINCT tt_lock_time_begin)=8 as countTimeInfo')
            ->whereRaw('((tt_lock_object_id = ? )OR(tt_lock_object_id=0))
                    AND
                    (DATE(tt_lock_date)=DATE( ? ))',
                [$objectId, $dateInfo]
            )->first();
            return response()->json(['success'=>true, 'info'=>$lockInfo->countTimeInfo]);
        }

    }
    public function CreateLock(Request $request){


        return response()->json(['status'=>'success']);
    }


}
