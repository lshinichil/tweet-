<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\HashTag;
use App\Good;
//use App\User;

class TweetController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth', [
               'only' => ['create','store','edit','update','destroy']
     ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::all();
        $hoge = 'これはテスト';
            //Good()->count;

        $goods = Good::all();
//        $users = User::all();

        return view('tweet.index',[
            'tweets' => $tweets,
//  'users' => $users,
            'hoge' => $hoge,
            'goods' => $goods
        ]);

    //    return 'test';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tweet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'body' => ['required','string','max:255'],
            'hash_tags' => ['string','max:255']
        ]);

        $tweet = new Tweet;
        $tweet->body = $request->input('body');
        $tweet->user_id = $request->user()->id;
        $tweet->save();

        //HashTagの新規保存
        $hash_tag_names = preg_split('/\s+/',$request->input('hash_tags'),-1,PREG_SPLIT_NO_EMPTY);
        $hash_tags_id = [];
        foreach ($hash_tag_names as $hash_tag_name) {
                //既存のレコードがあれば、何もしない
                //なければ新規保存
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name,
            ]);
            $hash_tags_id[] = $hash_tag->id;

        }

        //中間テーブルの新規保存
        $tweet->hashTags()->sync($hash_tags_id);

        $request->session()->flash('flash_message','ツイートの新規投稿が完了しました');

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
        $tweet = Tweet::find($id);

        return view ('tweet.show',[
            'tweet' => $tweet
        ]);
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
        $tweet = tweet::find($id);

        return view( 'tweet.edit',[
            'tweet' => $tweet
        ]);
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
        $tweet = Tweet::find($id);
        $tweet->body = $request->input('body');
        $tweet->save();

        //HashTagの新規保存
        $hash_tag_names = preg_split('/\s+/',$request->input('hash_tags'),-1,PREG_SPLIT_NO_EMPTY);
        $hash_tags_id = [];
        foreach ($hash_tag_names as $hash_tag_name) {
            //既存のレコードがあれば、何もしない
            //なければ新規保存
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name,
            ]);
            $hash_tags_id[] = $hash_tag->id;

        }

        //中間テーブルの新規保存
        $tweet->hashTags()->sync($hash_tags_id);


        return redirect('/tweets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tweet = Tweet::find($id);
        $tweet->delete();

        return redirect('tweets');
    }

    public function showByHashTag($id){

        $hash_tag = HashTag::find($id);
        $goods = Good::all();


//        return redirect('tweets');

        return view('tweet.index', [
            'tweets' => $hash_tag->tweets,
            'goods' => $goods
        ]);
    }

    public function ins_good(){

     //   $good = new \App\Good;
     //   $good->tweets_id = '222';
     //   $good->users_id = '222';
     //   $good->save();

        return redirect('/tweets');



    }
}
