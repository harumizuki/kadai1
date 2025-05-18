<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
</head>
<body>
    <h1>内容確認</h1>

    <form action="/contact/thanks" method="POST">
        @csrf

        <!-- 姓名 -->
        <div style="margin-bottom: 15px;">
            <label>お名前：</label><br>
            {{ $inputs['last_name'] }} {{ $inputs['first_name'] }}
            <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
            <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        </div>

        <!-- 性別 -->
        <div style="margin-bottom: 15px;">
            <label>性別：</label><br>
            @php
                $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'];
            @endphp
            {{ $genderText[$inputs['gender']] ?? '未選択' }}
            <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
        </div>

        <!-- メール -->
        <div style="margin-bottom: 15px;">
            <label>メールアドレス：</label><br>
            {{ $inputs['email'] }}
            <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        </div>

        <!-- 電話番号 -->
        <div style="margin-bottom: 15px;">
            <label>電話番号：</label><br>
            {{ $inputs['tel'] }}
            <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
        </div>

        <!-- 住所 -->
        <div style="margin-bottom: 15px;">
            <label>住所：</label><br>
            {{ $inputs['address'] }}
            <input type="hidden" name="address" value="{{ $inputs['address'] }}">
        </div>

        <!-- 建物名 -->
        <div style="margin-bottom: 15px;">
            <label>建物名：</label><br>
            {{ $inputs['building_name'] }}
            <input type="hidden" name="building_name" value="{{ $inputs['building_name'] }}">
        </div>

        <!-- 種類 -->
        <div style="margin-bottom: 15px;">
            <label>お問い合わせ種別：</label><br>
            @php
                $categoryText = [
                    1 => '商品のお届けについて',
                    2 => '商品の交換について',
                    3 => '商品トラブル',
                    4 => 'ショップへのお問い合わせ',
                    5 => 'その他'
                ];
            @endphp
            {{ $categoryText[$inputs['category_id']] ?? '未選択' }}
            <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
        </div>

        <!-- 内容 -->
        <div style="margin-bottom: 15px;">
            <label>お問い合わせ内容：</label><br>
            {!! nl2br(e($inputs['content'])) !!}
            <textarea name="content" style="display: none;">{{ old('content', $inputs['content']) }}</textarea>
        </div>

        <!-- ボタン -->
        <div style="margin-top: 20px;">
            <button type="submit">送信する</button>
        </div>
    </form>

    <form action="/contact" method="GET" style="margin-top: 10px;">
        <button type="submit">修正する</button>
    </form>
</body>
</html>
