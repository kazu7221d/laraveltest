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
      <th>id</th>
      <th>記事タイトル</th>
      <th>割引額</th>
      <th>割引率</th>
      <th>掲載日</th>
    </th>
    @foreach ($articles as $a)
    <tr>
      <td>{{ $a->id              }}</td>
      <td>{{ $a->title           }}</td>
      <td>{{ $a->discount_amount }}</td>
      <td>{{ $a->discount_rate   }}</td>
      <td>{{ $a->posting_date    }}</td>
    </th>
    @endforeach
    @foreach ($text as $t)
      {{ $t }} <br />
    @endforeach
  </table>
@endsection
