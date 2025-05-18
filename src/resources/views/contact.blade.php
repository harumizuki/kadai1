<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>
    <h1>お問い合わせフォーム</h1>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('/contact/confirm') }}" method="POST">
        @csrf

        <!-- 名前（姓・名） -->
        <div>
            <label>お名前<span style="color: red;">※</span></label><br>
            姓：<input type="text" name="last_name" value="{{ old('last_name') }}" required>
            名：<input type="text" name="first_name" value="{{ old('first_name') }}" required>
        </div>

        <!-- 性別 -->
        <div>
            <label>性別<span style="color: red;">※</span></label><br>
            <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>男性
            <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性
            <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他
        </div>

        <!-- メールアドレス -->
        <div>
            <label>メールアドレス<span style="color: red;">※</span></label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- 電話番号 -->
        <div>
            <label>電話番号<span style="color: red;">※</span></label><br>
            <input type="text" name="tel" value="{{ old('tel') }}" required>
        </div>

        <!-- 住所 -->
        <div>
            <label>住所<span style="color: red;">※</span></label><br>
            <input type="text" name="address" value="{{ old('address') }}" required>
        </div>

        <!-- 建物名 -->
        <div>
            <label>建物名</label><br>
            <input type="text" name="building_name" value="{{ old('building_name') }}">
        </div>

        <!-- お問い合わせの種類 -->
        <div>
            <label>お問い合わせの種類<span style="color: red;">※</span></label><br>
            <select name="category_id" required>
                <option value="">選択してください</option>
                <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <!-- お問い合わせ内容 -->
        <div>
            <label>お問い合わせ内容<span style="color: red;">※</span></label><br>
            <textarea name="content" maxlength="120" required>{{ old('content') }}</textarea>
        </div>

        <!-- 確認画面へ -->
        <div style="margin-top: 20px;">
            <button type="submit">確認画面へ</button>
        </div>

    </form>
</body>
</html>
