@extends('layout')

@section('content')
  <h1>Articles</h1>

  {!! Form::open(array('url' => 'search', 'method' => 'get')) !!}
    <div class="input-group mb-3">
      {!! Form::label('search_word', 'Search Word') !!}
      {!! Form::text('search_word', null, ['class' => 'form-control', 'placeholder' => 'Input Word', 'aria-describedby' => 'basic-addon1' ]) !!}
      {!! Form::submit('Search', ['class' => 'button button-primary form-control']) !!}
    </div>
  {!! Form::close() !!}
  <table class='table table-striped'>
    <tr>
      <!--<th>id</th>-->
      <th>見出し</th>
      <th>製品名</th>
      <th>割引率・割引額</th>
      <th>掲載日</th>
      <th>URL</th>
    </th>
    @foreach ($articles as $a)
    <tr>
      <!--<td>id</td>-->
      <td>{{ $a['title'] }}</td>
      <td>{{ $a['product'] }}</td>
      <td>{{ $a['discount'] }}</td>
      <td>{{ $a['posting_date'] }}</td>
      <td><a href="{{ $a['url'] }}">リンク</a></td>
    </th>
    @endforeach
  </table>
@endsection
