@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="product-list">
    <div class="product-list__heading">
        <div class="product-list__heading content__heading">商品一覧</div>
        <input class="product-list__heading content__heading btn btn" type="submit" value="+商品を追加">
    </div>
</div>
