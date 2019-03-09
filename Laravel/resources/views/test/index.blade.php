<a class="btn btn-info" href="/tests/create">testsボタン</a>
<a class="btn btn-info" href="/goods">goodsボタン</a>

<table class="table">
@foreach($tests as $test)
    <tr>
        <td>   {{ $test->body }} </td>
        <td>   {{ $test->id }}</td>
        <td class="text-right"><a href="/tests/{{$test->id}}"> 詳細 </a>></td>

        <td>
            <form action="/goods" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="tweets_id" value='{{$test->id}}'>
                <input type="hidden" name="users_id" value='5'>
                <button type="submit" class="btn btn-primary">いいね</button>
          </form>
        </td>

        <td>
        </td>

    </tr>
@endforeach
</table>
