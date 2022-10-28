@extends('layout')

@section('title')
   List of products
@endsection

@section('content')
   <div class="row">
      <div class="col">
         <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
      </div>
   </div>
   <hr>
   <div class="row">
      @foreach ($products as $product)
         <div class="card m-1">
            <div class="card-body">
               <h5 class="card-title">{{ $product->name }}</h5>
               <p class="card-text">{{ $product->description }}</p>
               <div>
                  @foreach ($product->getMedia($mediaCollection) as $media)
                     <img src="{{ $media->getUrl() }}" style="height: 200px; width: 200px" class="img-thumbnail"
                        alt="{{ $media->getUrl() }}">
                  @endforeach
               </div>
               <div class="my-1">
                  <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-info">Edit</a>
                  <form class="d-inline mx-1" action="{{ route('products.delete', ['id' => $product->id]) }}"
                     method="POST">
                     @method('DELETE')
                     @csrf
                     <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
               </div>
            </div>
         </div>
      @endforeach
   </div>
@endsection
