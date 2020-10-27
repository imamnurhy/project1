@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}">
@endsection

@section('content')
<div class="page has-sidebar-left bg-light">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h4 id="header">
                        <i class="icon icon-notebook-list"></i> Tambah Jenis Asset
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pegawai-tab" role="tablist">
                    <li>
                        <a class="nav-link" href="{{ route('pegawai.index') }}"><i
                                class="icon icon-arrow_back"></i>Semua
                            Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container-fluid my-3">
        <div id="alert"></div>
        <form class="needs-validation" method="POST" id="form" novalidate>
            @csrf
            @method('POST')
            <input type="hidden" id="id" name="id" />

            <div class="card no-b  no-r">
                <div class="card-body">
                    <h5 class="card-title" id="formTitle">Tambah Data</h5>
                    <div class="form-row form-inline">
                        <div class="col-md-6">
                            <div class="form-group m-0">
                                <label for="nik" class="col-form-label s-12 col-md-4">NIK</label>
                                <input type="text" name="nik" id="nik" placeholder=""
                                    class="form-control r-0 light s-12 col-md-6" autocomplete="off" required />
                                <a href="#" class="btn btn-xs col-md-2" onclick="getNik()" id="getNik"><i
                                        class="icon-search"></i>
                                    Cari</a>
                            </div>
                            <div class="form-group m-0">
                                <label for="n_pegawai" class="col-form-label s-12 col-md-4">Nama</label>
                                <input type="text" name="n_pegawai" id="n_pegawai" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                            </div>
                            <div class="form-group m-0">
                                <label for="t_lahir" class="col-form-label s-12 col-md-4">Tempat L</label>
                                <input type="text" name="t_lahir" id="t_lahir" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                            </div>
                            <div class="form-group m-0">
                                <label for="d_lahir" class="col-form-label s-12 col-md-4">Tanggal L</label>
                                <input type="text" name="d_lahir" id="d_lahir" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                            </div>
                            <div class="form-group m-0">
                                <label for="jk" class="col-form-label s-12 col-md-4">Gender</label>
                                <select name="jk" id="jk" placeholder="" class="form-control r-0 light s-12 col-md-8"
                                    autocomplete="off" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group m-0">
                                <label for="pekerjaan" class="col-form-label s-12 col-md-4">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                            </div>
                            <div class="form-group m-0">
                                <label for="provinsi_id" class="col-form-label s-12 col-md-4">Provinsi</label>
                                <select name="provinsi_id" id="provinsi_id" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" onchange="getKabupaten()" required>
                                    <option value="">Pilih</option>
                                    @foreach($provinsis as $key=>$provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->n_provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-0">
                                <label for="kabupaten_id" class="col-form-label s-12 col-md-4">Kabupaten</label>
                                <select name="kabupaten_id" id="kabupaten_id" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" onchange="getKecamatan()" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                            <div class="form-group m-0">
                                <label for="kecamatan_id" class="col-form-label s-12 col-md-4">Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" onchange="getKelurahan()" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                            <div class="form-group m-0">
                                <label for="kelurahan_id" class="col-form-label s-12 col-md-4">Kelurahan</label>
                                <select name="kelurahan_id" id="kelurahan_id" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                            
                            <div class="form-group m-0">
                                <label for="alamat" class="col-form-label s-12 col-md-4">Alamat</label>
                                <textarea name="alamat" id="alamat" placeholder=""
                                    class="form-control r-0 light s-12 col-md-8" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group m-0 ml-4">
                                <label for="nip" class="col-form-label s-12 col-md-4">NIP</label>
                                <input type="text" name="nip" id="nip" placeholder=""
                                    class="form-control r-0 light s-12 col-md-6" autocomplete="off" required />
                            </div>
                            <div class="form-group m-0 ml-4">
                                <label for="telp" class="col-form-label s-12 col-md-4">Telp</label>
                                <input type="text" name="telp" id="telp" placeholder=""
                                    class="form-control r-0 light s-12 col-md-6" autocomplete="off" required />
                            </div>
                            <div class="form-group m-0 ml-4">
                                <label for="tmopd_id" class="col-form-label s-12 col-md-4">OPD</label>
                                <select name="tmopd_id" id="tmopd_id" placeholder=""
                                    class="form-control r-0 light s-12 col-md-6" required>
                                    <option value="">Pilih</option>
                                    @foreach($tmopds as $key=>$tmopd)
                                    <option value="{{ $tmopd->id }}">{{ $tmopd->n_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group m-0">
                                <label for="tmjenis_aset_id" class="col-form-label s-12 col-md-4">Aset</label>
                                <div class="col-md-6">
                                    <select name="tmjenis_aset_id[]" id="tmjenis_aset_id" placeholder=""
                                        class="form-control select2 r-0 s-12 " multiple required>
                                        @foreach($tmjenis_asets as $key=>$tmjenis_aset)
                                        <option value="{{ $tmjenis_aset->id }}">{{ $tmjenis_aset->n_jenis_aset }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="card-body offset-md-3">
                                <button type="submit" class="btn btn-primary btn-sm" id="action" title="Simpan data"><i
                                        class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></button>
                                <a class="btn btn-sm" onclick="add()" id="reset" title="Reset inputan">Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-fancybox.min.js') }}"></script>

<script type="text/javascript">
    {{ $id == 0 ? 'add()' : 'edit('.$id.')'}}
    function add() {
        save_method = "add";
        $('#form').trigger('reset');
        $('#formTitle').html("Tambah Data");
        $('#form input[name=_method]').val('POST');
        $('#txtAction').html('');
        $('#reset').show();
        $('#getNik').show();
        $('#nik').focus();
    }

    function edit(id) {
        save_method = 'edit';
        var id = id;
        $('#alert').html('');
        // $('#form').trigger('reset');
        $('#formTitle').html("Edit Data");
        $('#txtAction').html(" Perubahan");
        $('#reset').hide();
        $('#getNik').hide();
        $('#form input[name=_method]').val('PATCH');
        $.ajax({
            url: "{{ route('pegawai.edit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                getWilayah(data);
                data = data.pegawai;
                $('#id').val(data.id);
                $('#nip').val(data.nip).focus();
                $('#n_pegawai').val(data.n_pegawai);
                $('#telp').val(data.telp);
                $('#alamat').val(data.alamat);
                if ($('#opd_id').val() == data.opd_id) {
                    $('#unitkerja_id').val(data.unitkerja_id);
                } else {
                    $('#opd_id').val(data.opd_id);
                    changeOpd(data.unitkerja_id);
                }
                $('#nik').val(data.nik);
                $('#t_lahir').val(data.t_lahir);
                $('#d_lahir').val(data.d_lahir);
                $('#jk').val(data.jk);
                $('#pekerjaan').val(data.pekerjaan);
                $('#tmopd_id').val(data.tmopd_id).trigger('change');
            },
            error: function () {
                console.log("Nothing Data");
                reload();
            }
        })
    }

    $("input#nik, input#nip").on({
        keydown: function (e) {
            if (e.which === 32)
                return false;
        },
        change: function () {
            this.value = this.value.replace(/\s/g, "");
        }
    });

    add();
    $('#form').on('submit', function (e) {
                if ($(this)[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    $('#alert').html('');
                    $('#action').attr('disabled', true);
                    if (save_method == 'add') {
                        url = "{{ route('pegawai.store') }}";
                    } else {
                        url = "{{ route('pegawai.update', ':id') }}".replace(':id', $('#id').val());
                    }
                    $.ajax({
                            url: url,
                            type: 'POST',
                            data: new FormData($(this)[0]),
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                $('#action').removeAttr('disabled');
                                if (data.success == 1) {
                                $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                                }
                            },
                            error: function (data) {
                                $('#action').removeAttr('disabled');
                                err = '';
                                respon = data.responseJSON;
                                $.each(respon.errors, function (index, value) {
                                    err = err + "<li>" + value + "</li>";
                                });

                            $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                                }
                            });
                        return false;
                    }
                    $(this).addClass('was-validated');
                });

        $('#v-pegawai-add-tab').click(function () {
            $.confrim({
                title: 'Asynchronous content',
                content: $('#addForm'),
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: true,
            });
        });

        $('#opd_id').change(function () {
            if ($(this).val() == '') {
                option = "<option value=''>Pilih</option>";
                $('#unitkerja_id').html(option);
                $('#unitkerja_id').val();
            } else {
                changeOpd();
            }
        });

        function changeOpd(id) {
            $('#unitkerja_id').html("<option value=''>Loading...</option>");
            url = "{{ route('getUnitkerja.pegawai', ':id') }}".replace(':id', $('#opd_id').val());
            $.get(url, function (data) {
                option = "<option value=''>Pilih</option>";
                $.each(data, function (index, value) {
                    option += "<option value='" + value.id + "'>" + value.n_unitkerja + "</li>";
                });
                $('#unitkerja_id').html(option);
            }, 'JSON').done(function () {
                $('#unitkerja_id').val(id);
            });
        }

        function getNik() {
            $('#getNik').addClass('disabled');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                        url: "{{ route('pegawai.getNik') }}",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '_method': 'POST',
                            '_token': csrf_token,
                            'nik': $('#nik').val()
                        },
                        success: function (data) {
                            $('#alert').html('');
                            $('#n_pegawai').val(data.NAMA_LGKP);
                            $('#t_lahir').val(data.TMPT_LHR);
                            $('#d_lahir').val(data.TGL_LHR);
                            $('#jk').val(data.JENIS_KLMIN);
                            $('#pekerjaan').val(data.JENIS_PKRJN);
                            $('#alamat').val(data.ALAMAT + ' RT. ' + data.NO_RT + ' RW. ' + data.NO_RW);
                            getWilayah(data);

                            //--- Error Wilayah
                            if (data.msg_err != '') {
                                $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data - dismiss = 'alert' aria-label='Close'><span aria-hidden= 'true'> × </span></button><strong> Aplikasi tidak dapat menemukan! < /strong> " + data.msg_err + "<br/> Silahkan lakukan pembaharuan data wilayah tersebut. </div>");
                                }
                                $('#getNik').removeClass('disabled');
                                $('#nip').focus();
                            },
                            error: function (data) {
                                $('#getNik').removeClass('disabled');
                                err = '';
                                respon = data.responseJSON;
                                $.each(respon.errors, function (index, value) {
                                    err = err + "<li>" + value + "</li>";
                                });
                                $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'> × </span></button> <strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol> </div>");
                                }
                            });
                    }

                    function getKabupaten(id) {
                        val = $('#provinsi_id').val();
                        option = " <option value=''> Pilih </option>";
                        if (val == "") {
                            $('#kabupaten_id').html(option);
                        } else {
                            $('#kabupaten_id').html("<option value=''>Loading...</option>");
                            url = "{{ route('pegawai.getKabupaten', ':id') }}".replace(':id', val);
                            $.get(url, function (data) {
                                $.each(data, function (index, value) {
                                    option += "<option value='" + value.id + "'>" + value.n_kabupaten + "</li>";
                                });
                                $('#kabupaten_id').html(option);
                            }, 'JSON');
                        }
                    }

                    function getKecamatan(id) {
                        val = $('#kabupaten_id').val();
                        option = " <option value=''> Pilih </option>";
                        if (val == "") {
                            $('#kecamatan_id').html(option);
                        } else {
                            $('#kecamatan_id').html("<option value=''>Loading...</option>");
                            url = "{{ route('pegawai.getKecamatan', ':id') }}".replace(':id', val);
                            $.get(url, function (data) {
                                $.each(data, function (index, value) {
                                    option += "<option value='" + value.id + "'>" + value.n_kecamatan + "</li>";
                                });
                                $('#kecamatan_id').html(option);
                            }, 'JSON');
                        }
                    }

                    function getKelurahan() {
                        val = $('#kecamatan_id').val();
                        option = "<option value=''>Pilih </option>";
                        if (val == "") {
                            $('#kelurahan_id').html(option);
                        } else {
                            $('#kelurahan_id').html("<option value=''>Loading...</option>");
                            url = "{{ route('pegawai.getKelurahan', ':id') }}".replace(':id', val);
                            $.get(url, function (data) {
                                $.each(data, function (index, value) {
                                    option += "<option value='" + value.id + "'>" + value.n_kelurahan + "</li>";
                                });
                                $('#kelurahan_id').html(option);
                            }, 'JSON');
                        }
                    }

                    function getWilayah(data) {
                        $('#provinsi_id').val(data.provinsi_id);

                        option = "<option value=''> Pilih </option>";
                        $.each(data.kabupatens, function (index, value) {
                            option += "<option value='" + value.id + "'>" + value.n_kabupaten + "</li>";
                        });
                        $('#kabupaten_id').html(option);
                        $('#kabupaten_id').val(data.kabupaten_id);

                        option = "<option value=''> Pilih </option>";
                        $.each(data.kecamatans, function (index, value) {
                            option += "<option value='" + value.id + "'>" + value.n_kecamatan + "</li>";
                        });
                        $('#kecamatan_id').html(option);
                        $('#kecamatan_id').val(data.kecamatan_id);

                        option = "<option value=''> Pilih </option>";
                        $.each(data.kelurahans, function (index, value) {
                            option += "<option value='" + value.id + "'>" + value.n_kelurahan + "</li>";
                        });
                        $('#kelurahan_id').html(option);
                        $('#kelurahan_id').val(data.kelurahan_id);
                    }

</script>
@endsection
