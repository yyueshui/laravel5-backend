@extends('backend.layouts.master')

@section('title', '编辑用户')

@section('breadcrumb')
    <li><i class="ace-icon fa fa-home home-icon"></i><a href="/admin/dashboard">主页</a></li>
    <li><a>用户管理</a></li>
    <li>编辑用户</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            {!! Form::model($user, ['route' => ['admin.auth.user.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}
                {!! Form::hidden('_method', 'PUT') !!}

                @include('backend.user._form')

                <div class="form-group">
                    <label class="col-lg-2 control-label">{{ trans('validation.attributes.active') }}</label>
                    <div class="col-lg-1">
                        <input type="checkbox" value="1" name="status" {{$user->status == 1 ? 'checked' : ''}} />
                    </div>
                </div><!--form control-->

            <div class="well">
                <div class="text-center">
                    <a href="{{route('admin.auth.user.index')}}" class="btn btn-info btn-xs">{{ trans('strings.return_button') }}</a>
                    <input type="submit" class="btn btn-success btn-xs" value="{{ trans('strings.save_button') }}" />
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete">删除</button>
                </div>
                <div class="clearfix"></div>
            </div><!--well-->
            {!! Form::close() !!}
        </div>

        {{-- Confirm Delete --}}
        @include('backend.partials.delete_modal', array('action' => route('admin.auth.user.destroy', $user->id)))
    </div>
@endsection

@section('scripts')
    {!! UEditor::js() !!}
    <script src="{{ asset('js/jquery-file-upload/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('js/jquery-file-upload/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('js/jquery-file-upload/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tag.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#file').fileupload({
                url: '/admin/upload/image',
                type: 'POST',
                dataType: 'json',
                done: function (e, data) {
                    $('#upload_image_preview').attr('src', data.result.image);
                    $('#page_image').val(data.result.image);
                }
            });
        });

    </script>
@endsection

