<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="control-label">{{ 'Nama Supplier' }}</label>
    <input class="form-control" name="nama" type="text" id="nama" value="{{ isset($supplier->nama) ? $supplier->nama : ''}}" >
    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
    <label for="alamat" class="control-label">{{ 'Alamat' }}</label>
    <input class="form-control" name="alamat" type="text" id="alamat" value="{{ isset($supplier->alamat) ? $supplier->alamat : ''}}" >
    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telepon') ? 'has-error' : ''}}">
    <label for="telepon" class="control-label">{{ 'Telepon' }}</label>
    <input class="form-control" name="telepon" type="text" id="telepon" value="{{ isset($supplier->telepon) ? $supplier->telepon : ''}}" >
    {!! $errors->first('telepon', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
