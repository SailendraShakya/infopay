@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
<div class="col-sm-12">
	<div class="card">
<div class="card-header">Add <strong>Product</strong></div>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach

</ul>
</div>
@endif

<form action="{{ url('products') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="card-body">

<div class="form-group row">
<label class="col-sm-2 col-form-label" for="input-small">Name</label>
<div class="col-sm-6">
<input class="form-control form-control-sm" id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label" for="input-normal">Description</label>
<div class="col-sm-6">
	<textarea class="form-control" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label" for="input-large">Price</label>
<div class="col-sm-6">
<input class="form-control form-control-lg" id="price" type="text" name="price" placeholder="Price" value="{{ old('price') }}">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label" for="input-large">Image URL</label>
	<div class="col-md-6">
	    <input type="file" name="image" class="form-control">
	</div>
</div>

</div>
<div class="card-footer">
<button class="btn btn-sm btn-primary" type="submit"> Submit</button>
<button class="btn btn-sm btn-danger" type="reset"> Reset</button>
</div>
</form>
</div>
</div>
</div>
</div>
@endsection