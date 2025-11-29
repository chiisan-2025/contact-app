@extends('layouts.app')

@section('content')
<div class="container">

    <h1>管理画面 - お問い合わせ一覧</h1>

    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <form action="{{ route('admin.search') }}" method="GET" style="margin-bottom:20px;">

    <!-- キーワード（名前・メール） -->
                <input type="text" name="keyword" placeholder="名前・メールで検索" value="{{ session('search.keyword') }}">

    <!-- 性別 -->
                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" @if(session('search.gender') == 1) selected @endif>男性</option>
                    <option value="2" @if(session('search.gender') == 2) selected @endif>女性</option>
                    <option value="3" @if(session('search.gender') == 3) selected @endif>その他</option>
                </select>

    <!-- 種類（カテゴリ） -->
                <select name="category_id">
                    <option value="">お問い合わせ種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                    @if(session('search.category_id') == $category->id) selected @endif>
                    {{ $category->content }}
                    </option>
                    @endforeach
                </select>

    <!-- 日付（ここは後でflatpickrにする） -->
                <input type="date" name="from" value="{{ session('search.from') }}">
                <input type="date" name="to"   value="{{ session('search.to') }}">

                <button type="submit">検索</button>

    <!-- リセット -->
                <a href="{{ route('admin.reset') }}">リセット</a>

            </form>

                <p style="margin-top:10px;">
                    <a href="{{ route('admin.export') }}">CSVエクスポート</a>
                </p>

        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>
                @if ($contact->gender == 1)
                    男性
                @elseif ($contact->gender == 2)
                    女性
                @elseif ($contact->gender == 3)
                    その他
                @endif
            </td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '' }}</td>

            <!-- 詳細ボタン（中身は後で作る） -->
            <td>
                <button
                    type="button"
                    class="detailBtn"
                    data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                    data-gender="{{ $contact->gender }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category->content ?? '' }}"
                    data-detail="{{ $contact->detail }}"
                >
                    詳細
                </button>
            </td>

            <!-- 削除ボタン（中身は後で作る） -->
            <td>
                <form action="{{ route('admin.delete', $contact->id) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('削除してよろしいですか？')">
                        削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    <!-- 詳細モーダル -->
                <div id="detailModal" class="modal" style="display:none;">
                    <div class="modal-content">

                        <span id="modalClose" class="modal-close">×</span>

                        <h2>お問い合わせ詳細</h2>
                        <p>お名前：<span id="modalName"></span></p>
                        <p>性別：<span id="modalGender"></span></p>
                        <p>メールアドレス：<span id="modalEmail"></span></p>
                        <p>電話番号：<span id="modalTel"></span></p>
                        <p>住所：<span id="modalAddress"></span></p>
                        <p>建物名：<span id="modalBuilding"></span></p>
                        <p>お問い合わせの種類：<span id="modalCategory"></span></p>
                        <p>お問い合わせ内容：</p>
                        <p id="modalDetail"></p>
                    </div>
                </div>

    <!-- ページネーション -->
    <div style="margin-top:20px;">
        {{ $contacts->links() }}
    </div>

</div>
<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        display: none;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #fff;
        padding: 20px;
        width: 400px;
        max-width: 90%;
        border-radius: 4px;
    }

    .modal-close {
        float: right;
        cursor: pointer;
        font-size: 20px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('detailModal');
        const closeBtn = document.getElementById('modalClose');

        const nameSpan = document.getElementById('modalName');
        const genderSpan = document.getElementById('modalGender');
        const emailSpan = document.getElementById('modalEmail');
        const telSpan = document.getElementById('modalTel');
        const addressSpan = document.getElementById('modalAddress');
        const buildingSpan = document.getElementById('modalBuilding');
        const categorySpan = document.getElementById('modalCategory');
        const detailP = document.getElementById('modalDetail');

        function genderLabel(num) {
            if (num == 1) return '男性';
            if (num == 2) return '女性';
            if (num == 3) return 'その他';
            return '';
        }

        document.querySelectorAll('.detailBtn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                nameSpan.textContent = this.dataset.name;
                genderSpan.textContent = genderLabel(this.dataset.gender);
                emailSpan.textContent = this.dataset.email;
                telSpan.textContent = this.dataset.tel;
                addressSpan.textContent = this.dataset.address;
                buildingSpan.textContent = this.dataset.building;
                categorySpan.textContent = this.dataset.category;
                detailP.textContent = this.dataset.detail;

                modal.style.display = 'flex';
            });
        });

        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
@endsection