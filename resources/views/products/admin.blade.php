
@extends('layouts.product')
@section('content')
    <main class="col-sm-9 offset-sm-4 col-md-5 offset-md-3 pt-3">
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Name<br><input type="text" name="name" class="form-control"></p>
            <p>Phone<br><input type="number" name="phone" class="form-control"></p>
            <p>Mail<br><input type="email" name="mail" class="form-control"></p>
            <p>Product's_name<br><input type="text" name="p_name" class="form-control"></p>
            <button type="submit" class="btn-success">save</button>
            <a class="col-sm-9 offset-sm-4 col-md-5 offset-md-8 pt-8 btn-success" href="{!! route('products.add') !!}">Add product</a>
            </form>
    </main>
@stop