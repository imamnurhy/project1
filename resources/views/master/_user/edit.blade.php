@extends('layouts.app')

@section('title', 'Edit User')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}">
@endsection

@section('content')
<div class="page has-sidebar-left bg-light height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h4>
                        <i class="icon icon-user"></i> Edit Data User
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pegawai-tab" role="tablist">
                    <li>
                        <a class="nav-link" href="{{ route('pegawai.index') }}"><i class="icon icon-arrow_back"></i>Semua Pegawai</a>
                    </li>
                    <!-- <li>
                        <a class="nav-link active" href="#""><i class="icon icon-pencil"></i>Edit Data User</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">
        <div id="alert"></div>
        <div class="card no-b">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active show" id="v-status-tab" data-toggle="pill" href="#v-status" role="tab" aria-controls="v-status" aria-selected="true">Status</a>
                            <a class="nav-link" id="v-username-tab" data-toggle="pill" href="#v-username" role="tab" aria-controls="v-username" aria-selected="true">Username</a>
                            <a class="nav-link" id="v-password-tab" data-toggle="pill" href="#v-password" role="tab" aria-controls="v-password" aria-selected="false">Password</a>
                            <a class="nav-link" id="v-pills-roles-tab" data-toggle="pill" href="#v-pills-roles" role="tab" aria-controls="v-pills-roles" aria-selected="false">List Role</a>
                            <br/>
                            @if(Auth::user()->id != $user->id)
                            <a class="btn btn-danger" onclick="removeUser({{ $user->id }})">Hapus User</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-9">
                        <input type="hidden" id="id" name="id" value="{{ $user->id }}"/>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="v-status" role="tabpanel" aria-labelledby="status-tab">
                                <form class="needs-validation" id="form1" method="POST" novalidate>
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="type" value="1"/>
                                    <ul class="list-group col-5">
                                        <li class="list-group-item">
                                            <strong class="s-12 ml-4">Status User</strong>
                                            <div class="material-switch float-right">
                                                <input id="c_status" name="c_status" type="checkbox" @if($user->status == 1) checked="c_status" @endif onclick="send_data(1)"/>
                                                <label for="c_status" class="bg-primary"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-username" role="tabpanel" aria-labelledby="username-tab">
                                <form class="needs-validation" id="form2" method="POST" novalidate>
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="type" value="2"/>
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="username" class="col-form-label s-12 col-md-3">Username</label>
                                                <input type="text" name="username" id="username" placeholder="" class="form-control r-0 light s-12 col-md-4" value="{{ $user->username }}" required/>
                                            </div>
                                            <div class="card-body offset-md-3">
                                                <a href="#" class="btn btn-primary btn-sm" id="action2" onclick="send_data(2)"><i class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-password" role="tabpanel" aria-labelledby="v-password-tab">
                                <form class="needs-validation" id="form3" method="POST" novalidate>
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="type" value="3"/>
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="password" class="col-form-label s-12 col-md-3">Password</label>
                                                <input type="password" name="password" id="password" placeholder="" class="form-control r-0 light s-12 col-md-4" required/>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="password_confirmation" class="col-form-label s-12 col-md-3">Ulangi Password</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="" class="form-control r-0 light s-12 col-md-4" required data-match="#password"/>
                                            </div>
                                            <div class="card-body offset-md-3">
                                                <a href="#" class="btn btn-primary btn-sm" id="action3" onclick="send_data(3)"><i class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-pills-roles" role="tabpanel" aria-labelledby="v-pills-roles-tab">
                                <div class="row">  
                                    <div class="col-6">
                                        <form class="needs-validation" id="form4" method="POST" novalidate>
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="type" value="4"/>
                                            <div class="form-row form-inline">
                                                <div class="col-md-12">
                                                    <div class="form-group m-0">
                                                        <label for="role" class="col-form-label s-12 col-md-3">Role</label>
                                                        <div class="col-md-9">
                                                            <select name="roles[]" id="role" placeholder="" class="select2 form-control r-0 light s-12" multiple="multiple" required>
                                                                @foreach($roles as $key=>$role)
                                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                                @endforeach
                                                            <select>
                                                        </div>
                                                    </div>
                                                    <div class="card-body offset-md-3">
                                                        <a href="#" class="btn btn-primary btn-sm" id="action4" onclick="send_data(4)"><i class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <strong>List Role:</strong>
                                        <ol id="viewRole" class=""></ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
    getRoles();
    function send_data(no){
        if ($('#form' + no)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action' + no).addClass('disabled');
            
            url = "{{ route('user.update', ':id') }}".replace(':id', $('#id').val());
            data = new FormData($('#form' + no)[0]);
            $.ajax({
                url : url,
                type : 'POST',
                data: data,
                contentType: false,
                processData: false,
                success : function(data) {
                    $('#action' + no).removeClass('disabled');
                    if(data.success == 1){
                        $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                        if(no == 4){
                            getRoles();
                        }
                    }
                },
                error : function(data){
                    $('#action' + no).removeClass('disabled');
                    err = '';
                    respon = data.responseJSON;
                    $.each(respon.errors, function( index, value ) {
                        err = err + "<li>" + value +"</li>";
                    });

                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                }
            });
            return false;
        }
        $('#form' + no).addClass('was-validated');
    }

    function getRoles(){
        $('#viewRole').html("Loading...");
        urlRole = "{{ route('user.getRoles', ':id') }}".replace(':id', $('#id').val());
        $.get(urlRole, function(data){
            $('#viewRole').html("");
            if(data.length > 0){
                $.each(data, function(index, value){
                    val = "'" + value + "'";
                    $('#viewRole').append('<li>' + value + ' <a href="#" onclick="removeRole(' + val + ')" class="text-danger" title="Hapus Data"><i class="icon-remove"></i></a></li>');
                });
            }else{
                $('#viewRole').html("<em>Data role kosong.</em>");
            }
        });
    }

    function removeRole(name){
        $.confirm({
            title: '',
            content: 'Apakah Anda yakin akan menghapus role ini?',
            icon: 'icon icon-question amber-text',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {   
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        var csrf_token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url : "{{ route('user.destroyRole', ':name') }}".replace(':name', name),
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : csrf_token, 'id' : $('#id').val()},
                            success : function(data) {
                                getRoles();
                            },
                            error : function () {
                                console.log('Opssss...');
                                reload();
                            }
                        });
                    }
                },
                cancel: function(){
                    console.log('the user clicked cancel');
                }
            }
        });
    }

    function removeUser(id){
        $.confirm({
            title: '',
            content: 'Apakah Anda yakin akan menghapus user ini?',
            icon: 'icon icon-question amber-text',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {   
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        var csrf_token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url : "{{ route('user.destroy', ':id') }}".replace(':id', id),
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : csrf_token},
                            success : function(data) {
                                document.location.href = "{{ route('pegawai.index') }}";
                            },
                            error : function () {
                                console.log('Opssss...');
                                reload();
                            }
                        });
                    }
                },
                cancel: function(){
                    console.log('the user clicked cancel');
                }
            }
        });
    }
</script>
@endsection