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
                ようこそ！　{{auth()->user()->name}} さん！
            </div>
            <div class="panel-body">
                
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
@endsection

