<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<input type="text" id="idTentor" name="idTentor" hidden value="{{$tentor->idTentor}}" />

<div class="form-group">
    <label>Nama Tentor</label>
    <input type="text" class="form-control" placeholder="Nama Tentor" id="namaTentor" name="namaTentor" value="{{$tentor->namaTentor}}">
</div>


<div class="form-group ">
    <label>Tanggal Lahir</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        <input type="text" class="form-control float-right datepicker" name="tanggalLahir" id="tanggalLahir" value="{{$tentor->tanggalLahir}}">
    </div>
</div>

<div class="form-group">
    <label>Biodata </label>
    <textarea class="form-control" rows="3" id="biodata" name="biodata">{{$tentor->biodata}}</textarea>
</div>

<div class="form-group">
    <label>Foto Tentor </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="urlFoto" name="urlFoto">
        <label class="custom-file-label" for="customFile">Pilih file</label>
    </div>
</div>

<div class="text-right">
    <button id="btnSimpan" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Simpan</button>
</div>

<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
