@extends('admin.layouts.main')

@section('content')
    <x-admin.title-content title="Main" />
    <!-- Main content -->
    <x-admin.small-box :$entities />
    <!--/. container-fluid -->
    <!-- /.content -->
@endsection
