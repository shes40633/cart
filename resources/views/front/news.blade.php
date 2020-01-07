
  @extends('layouts.front')
  @section('content')



<div class="container">
<div class="row">


        @foreach ($news as $new)
     <div class="col-12 com-md-4">
        <a href="/news/{{ $new ->id }}">
            <h1>{{$new->title}}</h1>
            </a>
</div>


@endforeach
{{ $news->links() }}
</div>
</div>


@endsection

