@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>商品登録</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">商品名
                <span class="create-form__required">必須</span>
            </label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">値段
                <span class="create-form__required">必須</span>
            </label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">商品画像
                <span class="create-form__required">必須</span>
            </label>
            <input type="file" name="image" id="image" class="form-control-file">
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>季節
                <span class="create-form__required">必須</span>
                <span class="create-form__multi-select">複数選択可</span>
            </label>
            @foreach($seasons as $season)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="season_ids[]" id="season_{{ $season->id }}" value="{{ $season->id }}"
                {{ is_array(old('season_ids')) && in_array($season->id, old('season_ids')) ? 'checked' : '' }}>
                <label class="form-check-label" for="season_{{ $season->id }}">{{ $season->name }}</label>
            </div>
            @endforeach
            @error('season_ids')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">商品説明
                <span class="create-form__required">必須</span>
            </label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
</div>
@endsection
