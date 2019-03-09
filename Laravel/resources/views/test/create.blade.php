<form action="/tests" method="post">
    {!! csrf_field() !!}

    <div class="form-group row">
        <label class="col-xs-2 col-form-label">test本文</label>
        <div class="col-xs-10">
            <input type="text" name="body" class="form-control" placeholder="ツイート本文を入力してください。" value="{{ old('body') }}"/>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-xs-offset-2 col-xs-10">
            <button type="submit" class="btn btn-primary">投稿する</button>
        </div>
    </div>
</form>