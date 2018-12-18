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
@endauth
@endsection

