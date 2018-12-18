@extends('layout')
@section('content')

@guest
<form action="/register" method="post" class="panel panel-info">
    {{csrf_field()}}
    <div class="panel-heading">
        会員登録はこちら
    </div>
    <div class="panel-body">
        <p>このサイトはデモサイトです。会員登録ボタンを押下後、自動的にダミーデータが入力されたアカウントが作成され、そのアカウントで自動ログインします。</p>
        <button class="btn btn-primary btn-lg center-block">会員登録</button>
    </div>
</form>
@endguest

@auth
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-info">
            {{csrf_field()}}
            <div class="panel-heading">
                ようこそ！　{{auth()->user()->name}} さん！ つぶやいてみましょう！
            </div>
            <div class="panel-body">
                <p class="alert alert-warning">下記のボタンでつぶやく事が出来ます。モデレートが手間なので、定型文のみ投稿できる仕様です。<br>攻撃的な内容をつぶやいた場合、一定時間後に自動的につぶやきが削除されます。</p>
                <div class="col-md-6">
                    <form action="{{route('tweet.store')}}" method="POST">
                        {{csrf_field()}}
                        <button class="btn btn-success btn-lg center-block" name='mode' value="normal">一般的な内容をつぶやく</button>
                    </form>
                </div>

                <div class="col-md-6">
                        <form action="{{route('tweet.store')}}" method="POST">
                            {{csrf_field()}}
                            <button class="btn btn-danger btn-lg center-block" name='mode' value="bad">攻撃的な内容をつぶやく</button>
                        </form>
                    </div>
            </div>
            <div class="panel-footer">
                <form action="/logout" method="post">
                    {{csrf_field()}}
                    <button class="btn btn-danger" onclick="return confirm('デモシステムの関係上、ログアウトすると再度ログインできませんがログアウトしますか？')">ログアウト</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-danger">
            {{csrf_field()}}
            <div class="panel-heading">
                解約処理
            </div>
            <div class="panel-body">
                Twitterにならいアカウント情報は退会手続きから30日間のみ保持されます。
            </div>
            <div class="panel-footer">
                <form action="/deactive" method="post">
                    {{csrf_field()}}
                    <button class="btn btn-danger" onclick="return confirm('一応確認しますが削除しますか？')">アカウントを削除する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

@foreach($tweets as $tweet)
<div class="panel panel-default">
    <div class="panel-heading">
        {{$tweet->user->name}}
    </div>
    <div class="panel-body">
            {{$tweet->message}}
    </div>
    <div class="panel-footer">
        @can('delete', $tweet)
        <div class="pull-right">
        <form method="POST" action='{{route("tweet.destroy", $tweet)}}'>
            {{ csrf_field() }}
            {{method_field('DELETE')}}
            <button class="btn btn-danger">投稿を削除</button>
        </form>
        </div>
        <div class="clearfix"></div>
        @endcan
    </div>
    

</div>
@endforeach
@endsection

