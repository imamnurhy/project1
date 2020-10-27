@extends('layouts.app')

@section('title', 'Profile')

@section('content')
@php $auth = Auth::user() @endphp
<div class="page has-sidebar-left bg-light">
    <header class="white b-b p-3 ">
       <div class="container-fluid">
            @if($auth->pegawai)
            <img class="d-flex mr-3 height-50 fotoLink" src="{{ $auth->pegawai->foto == '' ? asset('assets/img/dummy/u1.png') : env('SFTP_SRC').'foto/'.$auth->pegawai->foto }}" alt="photo" align="left">
            @else
            <img class="d-flex mr-3 height-50 fotoLink" src="{{ asset('assets/img/dummy/u1.png') }}" alt="photo" align="left">
            @endif
            <h3>
                {{ $auth->pegawai ? $auth->pegawai->n_pegawai : 'PROFIL' }}
            </h3>
            <strong>@ {{ $auth->username }}</strong>
       </div>
    </header>

    @if($auth->pegawai)
    <div class="container-fluid my-3">
        <div id="alert"></div>
        <div class="row">
            <div class="col-md-8 pr-0">
                <div class="card no-b">
                    <div class="card-body">
                        <strong><i class="icon icon-user"></i> Profil</strong>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row form-inline">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label class="col-form-label s-12 col-md-3">NIK</label>
                                            <input type="text" name="nik" id="nik" placeholder="" class="form-control r-0 light s-12 col-md-7" value="{{ $auth->pegawai->nik }}" disabled="disabled" required/>
                                        </div>
                                        <div class="form-group m-0">
                                            <label class="col-form-label s-12 col-md-3">Jenis Kelamin</label>
                                            <input type="text" name="jk" id="jk" placeholder="" class="form-control r-0 light s-12 col-md-7" value="{{ $auth->pegawai->jk }}" disabled="disabled" required/>
                                        </div>
                                        <div class="form-group m-0">
                                            <label class="col-form-label s-12 col-md-3">Tempat Lahir</label>
                                            <input type="text" name="t_lahir" id="t_lahir" placeholder="" class="form-control r-0 light s-12 col-md-7" value="{{ $auth->pegawai->t_lahir }}" disabled="disabled" required/>
                                        </div>
                                        <div class="form-group m-0">
                                            <label class="col-form-label s-12 col-md-3">Tanggal Lahir</label>
                                            <input type="text" name="d_lahir" id="d_lahir" placeholder="" class="form-control r-0 light s-12 col-md-7" value="{{ $auth->pegawai->d_lahir }}" disabled="disabled" required/>
                                        </div>
                                        <div class="form-group m-0">
                                            <label class="col-form-label s-12 col-md-3">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" id="pekerjaan" placeholder="" class="form-control r-0 light s-12 col-md-7" value="{{ $auth->pegawai->pekerjaan }}" disabled="disabled" required/>
                                        </div>
                                        <div class="form-group m-0">
                                            <label class="col-form-label s-12 col-md-3">Alamat</label>
                                            <textarea name="alamat" id="alamat" placeholder="" class="form-control r-0 light s-12 col-md-7" disabled="disabled" required>{{ $auth->pegawai->alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card no-b mb-3">
                    <div class="card-body" style="min-height:245px">
                        <strong class="card-title"><i class="icon icon-photo"></i> Foto</strong><br/>
                        <center>
                            <img src="{{ $auth->pegawai->foto == '' ? asset('assets/img/dummy/u1.png') : env('SFTP_SRC').'foto/'.$auth->pegawai->foto }}" alt="Photo" width="140px" class="fotoLink"/>
                            
                            <div class="col-md-12">
                                <span id="fotoLoading" style="display:none">Sedang mengunggah...</span>
                                <span id="fotoLoad">
                                    <input id="foto" type="file" onchange="sendFoto()"  style="display:none"/>
                                    <a class="btn" id="fotoBtn" onclick="uploadFoto()">Ubah Foto</a>
                                </span>
                            </div>
                        </center>
                    </div>
                </div>
                <a href="{{ route('account.password') }}" class="btn btn-warning col-md-12">Ubah Password</a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script type="text/javascript">

    //----- Upload Foto
    function uploadFoto(){
        $("#foto").trigger('click');
    }

    function sendFoto(){
        $('#fotoLoading').show();
        $('#fotoLoad').hide();
        var file = $('#foto')[0].files[0];
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        formData = new FormData();
        formData.append('_token', csrf_token);
        formData.append('file', file);
        url = "{{ route('account.updateFoto') }}";
        $.ajax({
            url : url,
            type : 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success : function(data) {
                console.log(data);
                $('.fotoLink').attr('src', '{{ env("SFTP_SRC") }}foto/' + data.file);

                $('#fotoLoading').hide();
                $('#fotoLoad').show();
                $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
            },
            error : function(data){
                err = '';
                respon = data.responseJSON;
                if(respon.errors){
                    $.each(respon.errors, function( index, value ) {
                        err = err + "<li>" + value +"</li>";
                    });
                }
                $('#fotoLoading').hide();
                $('#fotoLoad').show();
                $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                $('html, body').animate({ scrollTop: $('#alert').offset().top - 50 }, 500);
            }
        });
        return false;
    }
</script>
@endsection