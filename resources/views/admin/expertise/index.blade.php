@extends("admin.layouts.app")
@section("content")
<div class="card">
    <div class="card-header d-flex justify-content-between"><span>Manage Items</span><a href="{{ url()->current() }}/create" class="btn btn-primary btn-sm">Add New</a></div>
    <div class="card-body"><p>Add content management here</p></div>
</div>
@endsection
