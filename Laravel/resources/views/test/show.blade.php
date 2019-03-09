

<p>{{$test->body }}</p>
<p>{{$test->created_at}}</p>

<a href="/tests/{{$test->id}}/edit" class="btn btn-primary">更新</a>

<form action="/tests/{{ $test->id }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    {!! csrf_field() !!}
    <button type="sabmit" class="btn btn-danger">削除</button>
</form>
