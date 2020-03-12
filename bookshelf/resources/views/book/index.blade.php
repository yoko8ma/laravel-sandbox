@extends('book/layout')
@section('content')
  <div class="uk-container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">書籍一覧</h3>
    </div>
  </div>
  <div class="uk-grid.uk-width-1-1">
    <div class="uk-width-1-1">
      <table class="uk-table uk-table-divider">
        <tr>
          <th class="uk-text">ID</th>
          <th class="uk-text">書籍名</th>
          <th class="uk-text">著者</th>
          <th class="uk-text">削除</th>
        </tr>
        @foreach($books as $book)
        <tr>
          <td>
            <a href="/book/{{ $book->id }}/edit">{{ $book->id }}</a>
          </td>
          <td>{{ $book->title }}</td>
          <td>{{ $book->author }}</td>
          <td>
            <form action="/book/{{ $book->id }}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="uk-button" onclick="return confirm('Are you sure?')"><span uk-icon="icon: trash"></span></button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
      <div><a href="/book/create" class="uk-button uk-button-default">新規作成</a></div>
    </div>
  </div>
@endsection
