@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
				<div class="card">
				<div class="card-header"> Products
				
			</div>
			<div class="card-header">
				<a href="{{ route('products.create') }}">Add Product</a> 
			</div>
				<div class="card-body">
				@if(session()->has('message'))
				<div class="alert alert-success">
				{{ session()->get('message') }}
				</div>
				@endif
				@if ($errors->any())
				<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
				</div>
				@endif
				<table class="table table-responsive-sm">
					<thead>
					<tr>
						<th>Name</th>
						<th>Image</th>
						<th>Price</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($products as $product)
					<tr>
						<td>{{ $product->name }}</td>
						<td><img src="{{ $product->image }}" alt="{{ $product->name }}" height="120px"></td>
						<td>{{ $product->price }}</td>
						<td>{{ $product->created_at }}</td>
						<td>
							<form action="{{ route('products.destroy',$product->id) }}" method="POST">


							    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>

							    @csrf
							    @method('DELETE')

							    <button type="submit" class="btn btn-danger">Delete</button>
							</form>
            </td>
					</tr>
					@endforeach
					</tbody>
					</table>
				</div>
				</div>
				</div>
     </div>
    </div>
@endsection
