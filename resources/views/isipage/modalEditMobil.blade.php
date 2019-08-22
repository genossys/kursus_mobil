<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<input type="text" id="idMobil" name="idMobil" hidden value="{{$mobil->idMobil}}">

<div class="form-group">
    <label>Merk Mobil</label>
    <input type="text" class="form-control" placeholder="Merk Mobil" id="merkMobil" name="merkMobil" value="{{$mobil->merkMobil}}">
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Type Mobil</label>
            <select class="form-control" id="typeMobil" name="typeMobil">
                <option value="{{$mobil->typeMobil}}">{{$mobil->typeMobil}}</option>
                <option disabled>_________________</option>
                <option value="Automatic">Automatic</option>
                <option value="Manual">Manual</option>
                <option value="Kombinasi">Kombinasi</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Tahun</label>
            <input id="tahun" type="number" class="form-control" name="tahun" value="{{$mobil->tahun}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Nopol</label>
            <input id="noPol" type="text" class="form-control" name="noPol" value="{{$mobil->noPol}}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Gambar Mobil </label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="urlFoto" name="urlFoto">
                <label class="custom-file-label" for="customFile">Pilih file</label>
            </div>
        </div>
    </div>
</div>

<div class="text-right">
    <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Simpan</button>
</div>
