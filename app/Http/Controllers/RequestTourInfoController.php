<?php

namespace App\Http\Controllers;

use App\Models\RequestTourInfo;
use App\Http\Requests\StoreRequestTourInfoRequest;
use App\Http\Requests\UpdateRequestTourInfoRequest;

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
        $requestTourInfo = RequestTourInfo::query()->get();

        return response()->json(['success'=>true, 'data'=>$requestTourInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequestTourInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestTourInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestTourInfo  $requestTourInfo
     * @return \Illuminate\Http\Response
     */
    public function show(RequestTourInfo $requestTourInfo, $id)
    {
        //
        $requestTourInfo = RequestTourInfo::query()->find($id);

        if($requestTourInfo != null){
            return response()->json(['success'=>true, 'data'=>$requestTourInfo]);
        } else {
            return response()->json(['success'=>false, 'error'=>'Информация не найдена']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestTourInfo  $requestTourInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestTourInfo $requestTourInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestTourInfoRequest  $request
     * @param  \App\Models\RequestTourInfo  $requestTourInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestTourInfoRequest $request, RequestTourInfo $requestTourInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestTourInfo  $requestTourInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestTourInfo $requestTourInfo)
    {
        //
    }
}
