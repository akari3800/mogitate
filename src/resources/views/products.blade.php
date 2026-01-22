@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css')}}">
@endsection

@section('link')
<a class="header__link" href="{{ route('products.create') }}">＋商品を追加</a>
@endsection

@section('content')
<div class="page">

   <div class="index-form">
       <h2 class="index-form__heading content__heading">商品一覧</h2>
   </div>

   <div class="search-area">
     <div class="sidebar">
       <form method="GET" action="/products/search" class="search-form">

          <div class="pair">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit">検索</button>
          </div>
    
          <div class="pair">
             <h3>価格順で表示</h3>
             <select name="select-box">
                <option value="">価格で並び替え</option>
                <option value="price_asc" {{ request('select-box') == 'price_asc' ? 'selected' : '' }}>低い順に表示</option>
                <option value="price_desc" {{ request('select-box') == 'price_desc' ? 'selected' : '' }}>高い順に表示</option>
             </select>
          </div>
         </form>

         @if(request('select-box'))
           <div class="modal-window-area">
            <div class="modal-window">
               @if(request('select-box') == 'price_asc')
               低い順に表示
               @elseif(request('select-box') == 'price_desc')
               高い順に表示
               @endif

               <a href="{{ url()->current() }}?keyword={{ request('keyword') }}" class="window-close">×</a>
            </div>
           </div>
         @endif
      </div>
   


  <div class="main">
     @foreach($products as $product)
     <a href="{{ url('/products/detail/' . $product->id) }}" class="product-card-link">
       <div class="product-card">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
          <div class="info">
             <p>{{ $product->name }}</p>
             <p>￥{{ $product->price }}</p>
          </div>
       </div>
     </a>
     @endforeach
  </div>
 </div>


 <div class="pagination">
   <a class="arrow {{ $products->onFirstPage() ? 'disabled' : '' }}" href="{{ $products->onFirstPage() ? '#' : $products->previousPageUrl() }}">&lt;
   </a>

    @for ($i = 1; $i <= $products->lastPage(); $i++)
      <a href ="{{ $products->url($i) }}"
      class="page {{ $products->currentPage() == $i ? 'active' : '' }}">{{ $i }}
      </a>
    @endfor

   <a class="arrow {{ $products->hasMorePages() ? '' : 'disabled' }}" href="{{ $products->hasMorePages() ? $products->nextPageUrl() : '#'  }}">&gt;
   </a>
 </div>
</div>


@endsection