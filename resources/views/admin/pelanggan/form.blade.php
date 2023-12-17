<div class="form-group {{ $errors->has('kode_pelanggan') ? 'has-error' : ''}}">
    <label for="kode_pelanggan" class="control-label">{{ 'Kode Pelanggan' }}</label>
    <input class="form-control" name="kode_pelanggan" type="text" id="kode_pelanggan" value="{{ isset($pelanggan->kode_pelanggan) ? $pelanggan->kode_pelanggan : ''}}" >
    {!! $errors->first('kode_pelanggan', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nama_pelanggan') ? 'has-error' : ''}}">
    <label for="nama_pelanggan" class="control-label">{{ 'Nama Pelanggan' }}</label>
    <input class="form-control" name="nama_pelanggan" type="text" id="nama_pelanggan" value="{{ isset($pelanggan->nama_pelanggan) ? $pelanggan->nama_pelanggan : ''}}" >
    {!! $errors->first('nama_pelanggan', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
    <label for="alamat" class="control-label">{{ 'Alamat' }}</label>
    <input class="form-control" name="alamat" type="text" id="alamat" value="{{ isset($pelanggan->alamat) ? $pelanggan->alamat : ''}}" >
    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('no_telepon') ? 'has-error' : ''}}">
    <label for="no_telepon" class="control-label">{{ 'No Telepon' }}</label>
    <input class="form-control" name="no_telepon" type="text" id="no_telepon" value="{{ isset($pelanggan->no_telepon) ? $pelanggan->no_telepon : ''}}" >
    {!! $errors->first('no_telepon', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
