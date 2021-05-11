@extends('layouts.app')

@section('content')


    @if (session()->has('restored'))
      <div class="alert alert-success">
        {{ session()->get('restored') }}
      </div>
    @endif  
    
    @if (session()->has('delete'))
      <div class="alert alert-danger">
        {{ session()->get('delete') }}
      </div>
    @endif

    @if (session()->has('update'))
      <div class="alert alert-success">
        {{ session()->get('update') }}
      </div>
    @endif 

    @if (session()->has('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
    @endif

    @if (session()->has('trashed'))
      <div class="alert alert-danger">
        {{ session()->get('trashed') }}
      </div>
    @endif


  <div class="clearfix">
    <a href="{{ route('posts.create') }}"
    class="btn   btn-success"
    style="margin-bottom: 10px">
      Add Post
    </a>
  </div>
  <div class="card card-default">
    <div class="card-header">All Posts</div>
        @if ($posts->count() > 0)
          <table class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th class="float-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                  <tr style="margin-top: 10px" class="p-2">
                    <td>
                      <img src="{{ asset('storage/'.$post->image) }}"   width="150px" height="100px">
                    </td>
                    <td>
                      {{ $post->title }}
                    </td>
                    <td>
                      <form class="float-right ml-2"
                      action="{{route('posts.destroy', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                          <button class="btn btn-danger btn-sm">
                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                        </button>
                      </form>
                      @if (!$post->trashed())
                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary float-right btn-sm">Edit</a>
                      @else
                        <a href="{{route('trashed.restore', $post->id)}}" class="btn btn-primary float-right btn-sm">Restore</a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        @else
          <div class="card-body">
            <h1 class="text-center">
              No Posts Yet.
            </h1>
          </div>
        @endif
    </div>
  </div>
@endsection