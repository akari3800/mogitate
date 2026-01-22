@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="page">
  <div class="register-form">
    <div class="register-form__heading">
        <h2>商品登録</h2>
    </div>
    
    <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力" />
                </div>
                <div class="form__error">
                      @foreach($errors->get('name') as $error)
                        <p>{{ $error }}</p>
                      @endforeach
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">値段</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--number">
                    <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力" />
                </div>
                <div class="form__error">
                      @foreach($errors->get('price') as $error)
                        <p>{{ $error }}</p>
                      @endforeach
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <div class="image-preview">
                    <img id="preview" style="max-width:300px; display:none;">
                </div>
                <div class="form__input--image">
                    <label class="file-button">
                        ファイルを選択
                        <input type="file" name="image" id="imageInput" hidden accept="image/*">
                    </label>
                    <span id="fileName" class="file-name"></span>
                </div>
                <div class="form__error">
                      @foreach($errors->get('image') as $error)
                        <p>{{ $error }}</p>
                      @endforeach
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">季節</span>
                <span class="form__label--required">必須</span>
                <span class="form__label--required-select">複数選択可</span>
            </div>
            <div class="form__group-content">
                <div class="form__option--season">
                   <label>
                    <input type="checkbox" name="season[]" value="1" {{ in_array(1, old('season', [])) ? 'checked' : '' }}>春
                   </label>
                   <label>
                    <input type="checkbox" name="season[]" value="2"  {{ in_array(2, old('season', [])) ? 'checked' : '' }}>夏
                   </label>
                   <label>
                    <input type="checkbox" name="season[]" value="3"  {{ in_array(3, old('season', [])) ? 'checked' : '' }}>秋
                   </label>
                   <label>
                    <input type="checkbox" name="season[]" value="4"  {{ in_array(4, old('season', [])) ? 'checked' : '' }}>冬
                   </label>
                </div>
                <div class="form__error">
                      @foreach($errors->get('season') as $error)
                        <p>{{ $error }}</p>
                      @endforeach
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品説明</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                </div>
                <div class="form__error">
                      @foreach($errors->get('description') as $error)
                        <p>{{ $error }}</p>
                      @endforeach
                </div>
            </div>
        </div>

        <div class="form__button">
            <a href="{{ url('/products') }}" class="form__button-back">戻る
            </a>
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
  </div>
</div>


<script>
    document.getElementById('imageInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) {
            document.getElementById('fileName').textContent = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById('preview');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(file);
        document.getElementById('fileName').textContent = file.name;
    });
    
</script>


@endsection

