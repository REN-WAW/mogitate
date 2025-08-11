@extends('layouts.app')

<style>
th {
    background-color: #289ADC;
    color: white;
    padding: 5px 40px;
}

tr:nth-child(odd) td {
    background-color: #FFFFFF;
}

td {
    padding: 25px 40px;
    background-color: #EEEEEE;
    text-align: center;
}

svg.w-5.h-5 {
    width: 30px;
    height: 30px;
}
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<class="product-list">
    <div class="product-list__heading">
        <h1 class="product-list__heading content__heading">商品一覧</h1>
        <a href="{{ route('products.create') }}" class="btn btn">+商品を追加</a>
    </div>

    <div class = "main-content">
        <aside class="sidebar">
            <form class="search-form" action="{{ route('products.index') }}" method="GET">
                <input class="product-name-input" type="text" name="search" placeholder="商品名で検索">
                <button type = "submit">検索</button>
            </form>
            
            <div class="col-span-1 md:col-span-1">
                <form action="{{ route('products.index') }}" method="GET" id="sort-form">
                    <input type="hidden" name="search" value="{{ $search ?? '' }}">
                    <h3>価格順で表示</h3>
                    <select name="sort" class="form-select" onchange="document.getElementById('sort-form').submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="high" {{ ($sort ?? '') === 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ ($sort ?? '') === 'low' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                </form>
            </div>
            
            @if (!empty($sort))
            <div class="col-span-2 md:col-span-2 flex items-center">
                <span>
                    @if ($sort === 'high')
                    高い順に表示
                    @elseif ($sort === 'low')
                    低い順に表示
                    @endif
                    <a href="{{ route('products.index', ['search' => $search ?? '']) }}" >&times;</a>
                </span>
            </div>
            @endif
        </aside>

        <article class ="content">
            <div class="product-cards-container">
                @foreach ($products as $product)
                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="product-card-link">
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <p>¥{{ number_format($product->price) }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </article>
    </div>
    {{ $products->links() }}
</class>
@endsection