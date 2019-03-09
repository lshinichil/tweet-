@extends('layouts.default')

@section('page-title')
    ツイート一覧
@endsection

<table class="table">
    {{--
    <p> {{$hoge}} </p>
    <p>good table</p>
    --}}


    @foreach($goods as $good)
        <tr>
            <td>   Tweets_ID : {{ $good->tweets_id }} </td>
            <td>   Users_ID : {{ $good->users_id }}</td>

            <td class="text-right"></td>
        </tr>
    @endforeach


{{-- {{ $goods->where('tweets_id',1)->count() }} --}}
{{--    {{ $goods::where('tweet_id',1) }} --}}
{{--     ::where('tweets_id','1') --}}

</table>




@section('content')
    <div class="row">
        <div class="col-md-2">
            @if(Auth::check())
                :::: {{ Auth::user()->name }} ::::
                <a class="btn btn-primary" href="{{ route('tweets.create') }}">ツイート新規投稿</a>
            @endif
        </div>
        <div class="col-md-10">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
            <table class="table">
                <tbody>
                @foreach($tweets as $tweet)
                    <tr>
                        <td>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="">{{ $tweet->user->name }}</a>: {{ $tweet->body }}
                                </li>


                                @if(count($tweet->hashTags) > 0)
                                    <li>
                                        <ul class="list-inline">
                                            @foreach($tweet->hashTags as $hash_tag)
                                                <li>
                                                    <a href="{{route('hash_tags.tweets',['id' => $hash_tag->id])}}">
                                                            <span class="label label-info">
                                                                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> {{ $hash_tag->name }}
                                                            </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </td>

                        <td class="text-right"><a href="{{ route('comments.show', ['tweets_id' => $tweet->id]) }}">返信</a></td>
{{--                         --}}

                        <td class="text-right"><a href="{{ route('tweets.show', ['id' => $tweet->id]) }}">詳細</a></td>

                        {{-- ログインしてる状態のみいいねボタン　--}}


                            <td>
                                @if(Auth::check())
                                {{--デバック用--}}

{{--                                $tweets_id = "{{ $tweet->id}}"
                                $users_id = "{{ Auth::user()->id }}
                                $tweets_user_id = "{{ $tweet->user_id }}"

--}}
                                {{--いいねボタン--}}


                                @if( Auth::user()->id != $tweet->user_id )
                                    <form action="/goods" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="tweets_id" value='{{$tweet->id}}'>
                                        <input type="hidden" name="users_id" value='{{ Auth::user()->id }}'>
                                        <button type="submit" class="btn btn-primary">いいね</button>
                                        {{ $goods->where('tweets_id',$tweet->id)->count() }}
                                    </form>
                                @else
                                    <p>いいね  {{ $goods->where('tweets_id',$tweet->id)->count() }}<p>
                                @endif

                                @else
                                    <p>いいね  {{ $goods->where('tweets_id',$tweet->id)->count() }}<p>
                                @endif
                     {{--                   <ul clase="text-left">コメント
                                        </ul>

                                        --}}
                            </td>


                    </tr>




                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
