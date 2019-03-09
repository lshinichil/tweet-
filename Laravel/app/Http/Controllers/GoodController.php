<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Good;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return 'これはテスト';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //    $good = new \App\Good;
    //    $good->tweets_id = '222';
    //    $good->users_id = '222';
    //    $good->save();

        return redirect('/tweets');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//いいね　追加
    public function store(Request $request)
    {
          //$test = Good::where('tweets_id',$request->input('tweets_id'))->first();

          $check = Good::where('tweets_id',$request->input('tweets_id'))
            ->where('users_id',$request->input('users_id'))
            ->first();

          if (!$check)
          {
              //データベースに対象が無い場合、新規保存
              $check = new Good;
              $check->tweets_id = $request->input('tweets_id');
              $check->users_id = $request->input('users_id');
              $check->save();
          }else{
              //データベースに対象がある場合、削除
              $check->delete();
          }

        return redirect('/tweets');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
