<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<input id="id" name="id" value="{{$user->id}}" hidden>
<div class="form-group">
    <label for="username">{{ __('Username') }}</label>
    <input id="username" type="text" class="form-control" name="username" value="{{$user->username}}" required autocomplete="username" autofocus>
</div>
<div class="form-group">
    <label for="email">{{ __('E-Mail Address') }}</label>
    <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required autocomplete="email">
</div>
<div class="form-group">
    <label>Hak Akses</label>
    <select class="form-control" id="cBoxHakAkses" name="hakAkses">
        <option value="{{$user->hakAkses}}">{{$user->hakAkses}}</option>
        <option disabled>________________</option>
        <option value="admin">Admin</option>
        <option value="pimpinan">Pimpinan</option>
    </select>
</div>

<div class="text-right">
    <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Simpan</button>
</div>
</div>
