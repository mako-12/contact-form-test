@extends('layouts.app-auth')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('nav')
    <form class="header-nav__link" action="/logout" method="get">
        @csrf
        <button class="header-nav__button">logout</button>
    </form>
@endsection

@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h2>Admin</h2>
        </div>
        <div class="admin__content-inner">
            <form class="form" action="/admin" method="get">
                @csrf
                <div class="form-content">
                    <div class="search-form__item-input">
                        <input type="text" name="input" value="{{ old('input', $input ?? '') }}"
                            placeholder="名前やメールアドレスを入力してください">
                    </div>
                    <div class="search-form__item-input">
                        <select class="search-form__item-select--gender" name="gender" id="gender">
                            <option value="" selected hidden>性別</option>
                            <option value="">全て</option>
                            <option value="1"{{ old('gender') == '1' ? 'selected' : '' }}>男性</option>
                            <option value="2"{{ old('gender') == '2' ? 'selected' : '' }}>女性</option>
                            <option value="3"{{ old('gender') == '3' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                    <div class="search-form__item--input">
                        <select name="category_id" id="category_id" class="search-form__item-select--kinds">
                            <option value="" selected hidden>お問い合わせの種類</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}"{{ $kind == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['content'] }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="search-form__item--input">
                        <input type="date" name="date" value="{{ old('date', $date ?? '') }}">

                    </div>



                    <div class="form-button">
                        <div class="search-form__button">
                            <button class="search-form__button-submit" type="submit">検索</button>
                        </div>
                        <div class="search-form__button">
                            <button class="search-form__button-submit--reset" type="submit" name="reset">
                                リセット
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="admin-utilities">
            <div class="admin-utilities-item">
                <input class="admin__export" type="submit" value="エクスポート">
            </div>

            {{ $contacts->appends(request()->query())->links('vendor.pagination.semantic-ui') }}
        </div>



        <div class="list-table">

            <table class="list-table__inner">
                <tr class="list-table__row">
                    <th class="list-table__header--name">お名前</th>
                    <th class="list-table__header--gender">性別</th>
                    <th class="list-table__header--email">メールアドレス</th>
                    <th class="list-table__header--kinds">お問い合わせの種類</th>
                    <th></th>
                </tr>
                @foreach ($contacts as $contact)
                    <tr class="list-table__row">
                        <td class="list-table__item">
                            {{ $contact['last_name'] }}
                            {{ $contact['first_name'] }}
                        </td>
                        <td class="list-table__item">
                            @if ($contact['gender'] == 1)
                                男性
                            @elseif($contact['gender'] == 2)
                                女性
                            @elseif($contact['gender'] == 3)
                                その他
                            @endif
                        </td>
                        <td class="list-table__item">
                            {{ $contact['email'] }}
                        </td>
                        <td class="list-table__item">
                            {{ $contact->category->content }}
                        </td>
                        <td class="list-table__item">
                            <a href="">詳細</a>
                        </td>
                @endforeach
                </tr>



            </table>

        </div>
    </div>
@endsection
