@extends('layouts.app')

@section('content')

   @if (session()->has('destroy'))
      <div class="alert alert-danger">
        {{ session()->get('destroy') }}
      </div>
    @endif

    @if (session()->has('success_update'))
      <div class="alert alert-success">
        {{ session()->get('success_update') }}
      </div>
    @endif

   

    @if (session()->has('success_store'))
      <div class="alert alert-success">
        {{ session()->get('success_store') }}
      </div>
    @endif
     
    <div class="clearfix">
    <a href="{{ route('categories.create') }}" class="btn float-right btn-success" style="margin-bottom: 10px">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">All Categories</div>
        <table class="card-body">
            <table class="table">
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{ $category->name }}
                            <span class="ml-2 badge badge-primary">{{$category->posts->count()}} post</span>
                        </td>
                        <td>
                            <form class="float-right ml-2" action="{{route('categories.destroy', $category->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary float-right btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection