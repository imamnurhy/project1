@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="page has-sidebar-left bg-light">
    <header class="white b-b p-3 ">
       <div class="container-fluid">
            @if(Auth::user()->pegawai)
            <img class="d-flex mr-3 height-50 fotoLink" src="{{ Auth::user()->pegawai->foto == '' ? asset('assets/img/dummy/u1.png') : env('SFTP_SRC').'foto/'.Auth::user()->pegawai->foto }}" alt="photo" align="left">
            @else
            <img class="d-flex mr-3 height-50 fotoLink" src="{{ asset('assets/img/dummy/u1.png') }}" alt="photo" align="left">
            @endif
            <h3>
                {{ Auth::user()->pegawai ? Auth::user()->pegawai->n_pegawai : 'PROFIL' }}
            </h3>
            <strong>@ {{ Auth::user()->username }}</strong>
       </div>
    </header>

    <div class="container-fluid my-3">
        <div id="alert"></div>
        <div class="card no-b">
            <div class="card-body">
                <strong><i class="icon icon-key3"></i> Ubah Password</strong>
                <form class="needs-validation" id="form" method="POST" novalidate>
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="form-row form-inline">
                        <div class="col-md-12">
                            <div class="form-group m-0">
                                <label for="password_last" class="col-form-label s-12 col-md-3">Password Lama</label>
                                <input type="password" name="password_last" id="password_last" placeholder="" class="form-control r-0 light s-12 col-md-4" required/>
                            </div><br/>
                            <div class="form-group m-0">
                                <label for="password" class="col-form-label s-12 col-md-3">Password Baru</label>
                                <input type="password" name="password" id="password" placeholder="" class="form-control r-0 light s-12 col-md-4" required/>
                            </div>
                            <div class="form-group m-0">
                                <label for="password_confirmation" class="col-form-label s-12 col-md-3">Ulangi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="" class="form-control r-0 light s-12 col-md-4" required data-match="#password"/>
                            </div>
                            <div class="card-body offset-md-3">
                                <button class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            $.ajax({
                url : "{{ route('account.password') }}",
                type : 'POST',
                data: new FormData($(this)[0]),
                contentType: false,
                processData: false,
                success : function(data) {
                    $('#action').removeAttr('disabled');
                    $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                },
                error : function(data){
                    $('#action').removeAttr('disabled');
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
        $(this).addClass('was-validated');
    });
</script>
@endsection