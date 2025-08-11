@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="product-detail">
    <a href="{{ route('products.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> 商品一覧
    </a>
    <form class="update-form" action="{{ route('products.update', $product->id) }}" method="POST">
        @method('PATCH')
        @csrf
        
        <div class="form-group">
            <div class="image-preview-container">
                <img id="current-image" src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image" class="image-preview">
                <input type="file" name="image" id="image" class="form-control-file mt-2">
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">商品名</label>
            <input class="update-form__item-input" type="text" name="name" value="{{ old('name', $product->name) }}">
            <p class="contact-form__error-message">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>
        
        <div class="form-group">
            <label for="price">値段</label>
            <input class="update-form__item-input" type="number" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>季節</label>
            <div class="season-checkboxes">
                @php
                $seasons = is_array(old('season', $product->season)) ? old('season', $product->season) : explode(',', $product->season);
                @endphp
                <div class="checkbox-item">
                    <input type="checkbox" name="season[]" id="spring" value="春" {{ in_array('春', $seasons) ? 'checked' : '' }}>
                    <label for="spring">春</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="season[]" id="summer" value="夏" {{ in_array('夏', $seasons) ? 'checked' : '' }}>
                    <label for="summer">夏</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="season[]" id="autumn" value="秋" {{ in_array('秋', $seasons) ? 'checked' : '' }}>
                    <label for="autumn">秋</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="season[]" id="winter" value="冬" {{ in_array('冬', $seasons) ? 'checked' : '' }}>
                    <label for="winter">冬</label>
                </div>
            </div>
            @error('season')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
            <button type="submit" class="btn btn-primary">変更を保存</button>
        </div>
    </form>
    
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger delete-btn" onclick="return confirm('本当に商品を削除しますか？')">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
</div>
@endsection

