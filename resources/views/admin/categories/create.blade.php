@extends('admin.layout.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Create new Category</h3>
        </div>

        <div class="panel-body">
            <form action="{{ route('admin.category.store') }}" method="POST">
                {{ csrf_field() }}
                @include ('admin.categories.partials.form')
            </form>
        </div>
    </div>

@endsection