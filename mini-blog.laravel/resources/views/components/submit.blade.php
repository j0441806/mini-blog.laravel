@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">※入力に問題があります。再入力をお願いします。</div>
@endif
<form action="{{$action}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            @error('posts')
                <div class="alert alert-warning" role="alert">{{$message}}</div>
            @enderror
            <label for="inputFile" class="text-white">投稿文</label>
            <textarea class="form-control" id="inputPost" placeholder="Please input text." name="posts" value="" rows="4"></textarea>
        </div>
        @error('image')
            <div class="alert alert-warning" role="alert">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="inputFile" class="text-white">投稿画像</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputFile" name="image">
                <label class="custom-file-label" for="inputFile" data-browse="参照">ファイルを選択(ここにドロップすることもできます)</label>
            </div>
        </div>
        <hr/>
        <button type="submit" class="btn btn-lg btn-primary">{{$submit}}</button>
    </form>