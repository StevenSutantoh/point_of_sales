<div class="form-group {{ $errors->has('nama_customer') ? 'has-error' : ''}}">
    <label for="nama_customer" class="control-label">{{ 'Nama Customer' }}</label>
    <input class="form-control" name="nama_customer" type="text" id="nama_customer" value="{{ isset($customer->nama_customer) ? $customer->nama_customer : ''}}" >
    {!! $errors->first('nama_customer', '<p class="help-block">:message</p>') !!}
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
