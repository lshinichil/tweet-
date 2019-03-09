@extends('layouts.default')

@section('page-title')
    {{$tweet->user->name}} : {{ $tweet->body }}
@endsection

@section('content')

    <p>返信履歴 <p>

    <table class="table">
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>
                    <ul class="list-unstyled">
                        <li>
                            <p> {{$comment->user->name}} : {{$comment->body}}
                           <td class="text-left"><a href="/comments_show/{{$tweet->id}}/{{$comment->id}}">返信</a></td>
                            </p>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(Auth::check())
        ユーザー名 : {{ Auth::user()->name }}
    @endif


    <form action="{{ route('comments.store') }}" method="post">
    {!! csrf_field() !!}
        <input type="hidden" name="tweets_id" value='{{$tweet->id}}'>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">返信コメント</label>
            <div class="col-xs-10">
                <input type="text" name="body" class="form-control" placeholder="返信本文を入力してください。" />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
        </div>
    </form>
@endsection
