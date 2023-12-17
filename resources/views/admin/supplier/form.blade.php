<div class="form-group {{ $errors->has('kode_supplier') ? 'has-error' : ''}}">
    <label for="kode_supplier" class="control-label">{{ 'Kode Supplier' }}</label>
    <input class="form-control" name="kode_supplier" type="text" id="kode_supplier" value="{{ isset($supplier->kode_supplier) ? $supplier->kode_supplier : ''}}" >
    {!! $errors->first('kode_supplier', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nama_supplier') ? 'has-error' : ''}}">
    <label for="nama_supplier" class="control-label">{{ 'Nama Supplier' }}</label>
    <input class="form-control" name="nama_supplier" type="text" id="nama_supplier" value="{{ isset($supplier->nama_supplier) ? $supplier->nama_supplier : ''}}" >
    {!! $errors->first('nama_supplier', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alamat') ? 'has-error' : ''}}">
    <label for="alamat" class="control-label">{{ 'Alamat' }}</label>
    <input class="form-control" name="alamat" type="text" id="alamat" value="{{ isset($supplier->alamat) ? $supplier->alamat : ''}}" >
    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('kota') ? 'has-error' : ''}}">
    <label for="kota" class="control-label">{{ 'Kota' }}</label>
    <input class="form-control" name="kota" type="text" id="kota" value="{{ isset($supplier->kota) ? $supplier->kota : ''}}" >
    {!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('no_telepon') ? 'has-error' : ''}}">
    <label for="no_telepon" class="control-label">{{ 'No Telepon' }}</label>
    <input class="form-control" name="no_telepon" type="text" id="no_telepon" value="{{ isset($supplier->no_telepon) ? $supplier->no_telepon : ''}}" >
    {!! $errors->first('no_telepon', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
