@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="page">
  <div class="detail-form">

    <div class="select-fruits">
        <a href="{{ route('products.index')}}">商品一覧</a>　>
        <span>{{ $product->name }}</span>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

       <div class="item__position">

        <div class="item__left">
            <div class="image-preview">
            <img id="preview" src="{{ asset('storage/' . $product->image) }}">
            </div>
            <div class="form__input--image">
              <label class="file-button">
                    ファイルを選択
                <input type="file" name="image" id="imageInput" hidden accept="image/*">
              </label>
              <span id="fileName" class="file-name">{{ basename($product->image) }}</span>
            </div>
            <div class="form__error">
                @foreach($errors->get('image') as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>

        <div class="item__right">

          <div class="form__group">
           <div class="form__group-content">
               <span class="form__label--item">商品名</span>
               <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
           </div>
           <div class="form__error">
            @foreach($errors->get('name') as $error)
              <p>{{ $error }}</p>
            @endforeach
           </div>
          </div>

         <div class="form__group">
            <div class="form__group-content">
                <span class="form__label--item">値段</span>
                <input type="text" name="price" value="{{ old('price', $product->price )}}" placeholder="値段を入力">
            </div>
            <div class="form__error">
                @foreach($errors->get('price') as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
         </div>

         <div class="form__group">
            <div class="form__label-content">
                <span class="form__label--item">季節</span>
                @php
                  $oldSeasons = old('season');
                  if ($oldSeasons !== null) {
                    $selectedSeasons = $oldSeasons;
                  } else {
                    $selectedSeasons = [];
                    foreach($product->seasons as $season) {
                        $selectedSeasons[] = (string)$season->id;
                    }
                  }
                @endphp
                <div class="season-options">
                  <label><input type="checkbox" name="season[]" value="1" {{ in_array(1,$selectedSeasons) ? 'checked' : '' }}>春</label>
                  <label><input type="checkbox" name="season[]" value="2" {{ in_array(2,$selectedSeasons) ? 'checked' : '' }}>夏</label>
                  <label><input type="checkbox" name="season[]" value="3" {{ in_array(3,$selectedSeasons) ? 'checked' : '' }}>秋</label>
                  <label><input type="checkbox" name="season[]" value="4" {{ in_array(4,$selectedSeasons) ? 'checked' : '' }}>冬</label>
                </div>
            </div>
            <div class="form__error">
                @foreach($errors->get('season') as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
         </div>
        </div>
       </div>

       <div class="item__position-description">

        <div class="form__group">
            <div class="form__group-content">
                <span class="form__label--item">商品説明</span>
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form__error">
                @foreach($errors->get('description') as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
       </div>

       <div class="form__button">
        <div class="button-center">
          <a href="{{ route('products.index') }}" class="form__button-back">戻る
          </a>
          <button class="form__button-submit" type="submit">変更を保存</button>
        </div>
       </div>
    </form>

    <form action="/products/{{ $product->id }}/delete" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button">
                🗑
        </button> 
    </form>
  </div>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e){
        const file = e.target.files[0];
        if(!file) return;

        const reader =new FileReader();
        reader.onload = function(e){
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
        document.getElementById('fileName').textContent = file.name;
    });
</script>

@endsection