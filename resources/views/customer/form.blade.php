<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="control-label">{{ 'Nama Customer' }}</label>
    <input class="form-control" name="nama" type="text" id="nama" value="{{ isset($customer->nama) ? $customer->nama : ''}}" >
    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
    <label for="alamat" class="control-label">{{ 'Alamat' }}</label>
    <input class="form-control" name="alamat" type="text" id="alamat" value="{{ isset($customer->alamat) ? $customer->alamat : ''}}" >
    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telepon') ? 'has-error' : ''}}">
    <label for="telepon" class="control-label">{{ 'Telepon' }}</label>
    <input class="form-control" name="telepon" type="text" id="telepon" value="{{ isset($customer->telepon) ? $customer->telepon : ''}}" >
    {!! $errors->first('telepon', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
