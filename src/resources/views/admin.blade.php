<!-- resources/views/admin.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理画面</title>
</head>
<body>
    <h1>管理画面</h1>
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ url('/admin') }}" method="GET">
    <div>
        <input type="text" name="keyword" placeholder="名前 or メールアドレスを検索" value="{{ request('keyword') }}">
    </div>
    <div>
        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>
    </div>
    <div>
        <select name="category_id">
            <option value="">お問い合わせ種類</option>
            <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
            <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>その他</option>
        </select>
    </div>
    <div>
        <input type="date" name="created_at" value="{{ request('created_at') }}">
    </div>
    <div>
        <button type="submit">検索</button>
        <a href="{{ url('/admin') }}">リセット</a>
    </div>
</form>


    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>住所</th>
                <th>建物名</th>
                <th>お問い合わせ種別</th>
                <th>お問い合わせ内容</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->gender }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->tel }}</td>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->building_name }}</td>
                <td>{{ $contact->category_id }}</td>
                <td>{{ $contact->content }}</td>
                <td>
    <button type="button" onclick="showModal({{ $contact->id }})">詳細</button>
    <form action="{{ route('admin.destroy', $contact->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
</form>

</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーションリンク -->
    <div>
        {{ $contacts->links() }}
    </div>
    <!-- モーダルウィンドウ -->
<div id="modal" style="display: none; position: fixed; top: 10%; left: 20%; width: 60%; background: white; border: 1px solid black; padding: 20px; z-index: 1000;">
    <div id="modal-content"></div>
    <button onclick="closeModal()">閉じる</button>
</div>

<script>
    function showModal(id) {
        const contact = @json($contacts);

        const selected = contact.data.find(c => c.id === id);

        if (selected) {
            document.getElementById('modal-content').innerHTML = `
                <p>名前：${selected.name}</p>
                <p>性別：${selected.gender == 1 ? '男性' : selected.gender == 2 ? '女性' : 'その他'}</p>
                <p>メールアドレス：${selected.email}</p>
                <p>電話番号：${selected.tel}</p>
                <p>住所：${selected.address}</p>
                <p>建物名：${selected.building_name ?? ''}</p>
                <p>お問い合わせ種類：${selected.category_id}</p>
                <p>お問い合わせ内容：${selected.content}</p>
            `;
            document.getElementById('modal').style.display = 'block';
        }
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>

</body>
</html>
