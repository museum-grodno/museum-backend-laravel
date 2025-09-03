<?php

namespace App\Http\Controllers;

use App\Models\RequestTourInfo;
use App\Models\Dictionaries;
use App\Models\DictinaryValue;
use App\Models\TimetableLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RequestTourInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $requestTourInfo = RequestTourInfo::query()->select(['rq_date_info','rq_time_start','rq_object_id','rq_count_customers','rq_organisation_name','rq_organisation_email'])->get();

        return response()->json($requestTourInfo);
    }
    public function viewFullEvent()
    {
        $requestTourInfo = RequestTourInfo::query()->get();

        return response()->json($requestTourInfo);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tour = RequestTourInfo::create([
            'rq_date_info' =>$request->tourDate,
            'rq_time_start' =>$request->tourTime,
            'rq_count_customers' =>$request->tourCount,
            'rq_object_id' => $request->tourObject,
            //'rq_is_excursions' =>,
            'rq_organisation_name' =>$request->tourName,
            'rq_organisation_address' =>$request->tourAdress,
            'rq_organisation_unp' =>$request->tourUnp,
            'rq_organisation_rs' =>$request->tourCash,
            'rq_organisation_contacts' =>$request->tourContacts,
            'rq_organisation_email' =>$request->tourEmail,
            'rq_count_customers_old' =>$request->tourOld,
            'rq_count_customers_pensioner' =>$request->tourPensioner,
            'rq_count_customers_student' =>$request->tourStudent,
            'rq_count_customers_pupil' =>$request->tourPupil,
            'rq_count_customers_toddler' =>$request->tourToddler,
            'rq_count_customers_lgotniki' =>$request->tourLgotniki
        ]);
        return response()->json(['success'=>true,]);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestTourInfo  $requestTourInfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $requestTourInfo = RequestTourInfo::query()->find($id);

        if($requestTourInfo != null){
            return response()->json(['success'=>true, 'info'=>$requestTourInfo]);
        } else {
            return response()->json(['success'=>false, 'error'=>'Информация не найдена']);
        }

    }
    public function getLockInfo(Request $request){
        if($request->lockTime != ''){
            $lockTimetable = TimetableLock::query()->
                where('tt_lock_date','=',DB::raw('date("'.$request->lockDate.'")'))
                ->where('tt_lock_time','=',$request->lockTime)
                ->get();
        }else{
            $lockTimetable = TimetableLock::query()->
            where('tt_lock_date','=',DB::raw('date("'.$request->lockDate.'")'))
                ->get();
        }

        return response()->json($lockTimetable);
    }
    public function UpdateEventInfo(Request $request)
    {

    }

    public function UpdateEventInfoStatus(Request $request,$id,$status)
    {
        $eventInfo = RequestTourInfo::query()->find($id);
        $eventInfo->rq_status = $status;
        $eventInfo->save();
    }
    public function getAllBranch(Request $request)
    {
        $dictionary = DB::table('dictionaries')
                        ->join('dictionary_value', 'dictionaries.dict_id', '=', 'dictionary_value.dict_id')
                        ->select('dictionary_value.dict_value_id','dictionary_value.value')
                        ->orderBy('dictionary_value.value')
                        ->get();


        //$dictionaryValue = DictinaryValue::query()->where('dict_id','=',$dictionary->dict_id);
        return response()->json($dictionary);
    }

    public function sendMail(){
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $yourEmail = 'rakandrzej@yandex.ru'; // ваш email на яндексе
        $password = 'yuyyoghdqjfeafcz'; // ваш пароль к яндексу или пароль приложения

        // настройки SMTP
        $mail->Mailer = 'smtp';
        $mail->Host = 'smtp.yandex.ru';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPOptions = array('ssl' => array('verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true));
        $mail->Username = $yourEmail; // ваш email - тот же что и в поле From:
        $mail->Password = $password; // ваш пароль;

// формируем письмо

// от кого: это поле должно быть равно вашему email иначе будет ошибка
        $mail->setFrom($yourEmail, 'Ваше Имя');

// кому - получатель письма
        $mail->addAddress('crsmok@gmail.com', 'Имя Получателя');  // кому

        $mail->Subject = 'Проверка';  // тема письма

$mail->msgHTML("<html><body>
				<h1>Проверка связи!</h1>
				<p>Это тестовое письмо.</p>
				</html></body>");
}
}
