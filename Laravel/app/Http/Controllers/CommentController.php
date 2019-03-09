<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Comment;
use App\User;

class CommentController extends Controller
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
        //
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
             'body' => ['required','string','max:255']
          ]);

          $comment = new Comment;
          $comment->tweets_id = $request->input('tweets_id');
          $comment->user_id = $request->user()->id;
          $comment->comments_id = '0';
          $comment->body = $request->input('body');
          $comment->save();

          //コメントshowに表示するデータを作成
          $id = $comment->tweets_id;
          $tweet = Tweet::find($id);
          $comments = Comment::where('tweets_id',$id)->get();

        return view ('comment.show',[
            'tweet'   => $tweet,
            'comments' => $comments
        ]);
    }

    public function comment_store(Request $request)
    {
        $this->validate($request,[
            'body' => ['required','string','max:255']
        ]);

        $comment = new Comment;
        $comment->tweets_id = $request->input('tweets_id');
        $comment->user_id = $request->user()->id;
        $comment->comments_id = $request->input('comments_id');
        $comment->body = $request->input('body');
        $comment->save();

        //コメントshowに表示するデータを作成
        $id = $comment->tweets_id;
        $tweet = Tweet::find($id);
        $comments = Comment::where('tweets_id',$id)->where('comments_id',$comment->comments_id)->get();



        //返信予定のツイート
//        $tweet = Tweet::find($tweets_id);
//        $comment = Comment::find($comments_id);

        //ツイートの関連するコメント
//        $comments = Comment::where('tweets_id',$tweets_id)->where('comments_id',$comments_id)->get();
//
        return view ('comment.comment_show',[
            'comment' => $comment,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
    }

    //$this->validate($request,[
        //    'body' => ['required','string','max:255']
        //]);


  //      $comment = new Comment;
  //      $comment->tweets_id = $request->input('tweets_id');
  //      $comment->user_id = $request->user()->id;
  //      $comment->comments_id = '0';
  //      $comment->body = $request->input('body');
  //      $comment->save();

        //コメントshowに表示するデータを作成
 //       $id = $comment->tweets_id;
 //       $tweet = Tweet::find($id);
 //       $comments = Comment::where('tweets_id',$id)->get();

//        return view ('comment.show',[
//            'tweet'   => $tweet,
//            'comments' => $comments
//        ]);



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::find($id);

        //ツイートの関連するコメント
        $comments = Comment::where('tweets_id',$id)->get();

        //全コメント
        //      $comments = Comment::all();

        return view ('comment.show',[
            'tweet'   => $tweet,
            'comments' => $comments
        ]);
    }

    public function comment_show($tweets_id,$comments_id)
    {
        //返信予定のツイート
        $tweet = Tweet::find($tweets_id);
        $comment = Comment::find($comments_id);

        //ツイートの関連するコメント
        $comments = Comment::where('tweets_id',$tweets_id)->where('comments_id',$comments_id)->get();


        //全コメント
        //      $comments = Comment::all();


        return view ('comment.comment_show',[
            'comment' => $comment,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
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
        //
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
