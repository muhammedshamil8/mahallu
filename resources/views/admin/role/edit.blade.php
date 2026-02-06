@extends('layouts.admin')
@section('title', 'Noble Mahallu | Edit Role')
@section('css_scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Role</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <!-- form start -->
            {!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!}
            @csrf
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br />
                            @foreach($permissionList as $modules)
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="checkbox tableCheckedAll">
                                                </th>
                                                <th>Module Name</th>
                                                <th>Create</th>
                                                <th>Edit</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($modules as $module => $verbs)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="checkbox rowCheckedAll">
                                                </td>
                                                <td>
                                                    {{$module}}
                                                </td>
                                                <td>
                                                    @if(isset($verbs['create']))
                                                    <input type="checkbox" class="checkbox" name="permission[]" value="{{ implode(',',$verbs['create']['ids'])}}" @if($verbs['create']['checked']) checked @endif>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($verbs['edit']))
                                                    <input type="checkbox" class="checkbox" name="permission[]" value="{{ implode(',',$verbs['edit']['ids'])}}" @if($verbs['edit']['checked']) checked @endif>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if(isset($verbs['list']))
                                                    <input type="checkbox" class="checkbox" name="permission[]" value="{{ implode(',',$verbs['list']['ids'])}}" @if($verbs['list']['checked']) checked @endif>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if(isset($verbs['delete']))
                                                    <input type="checkbox" class="checkbox" name="permission[]" value="{{ implode(',',$verbs['delete']['ids'])}}" @if($verbs['delete']['checked']) checked @endif>
                                                    @endif

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
    $(function() {
    $(".tableCheckedAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $(".rowCheckedAll").click(function(){
        var chkToggle;
        $(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
        var row = $(event.target).closest('tr');
        $('td input:checkbox:not(.rowCheckedAll)',row).prop('checked', this.checked);
    });
    })
</script>

@stop