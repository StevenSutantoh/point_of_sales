<div class="form-group {{ $errors->has('nama_kategori') ? 'has-error' : ''}}">
    <label for="nama_kategori" class="control-label">{{ 'Nama Kategori' }}</label>
    <input class="form-control" name="nama_kategori" type="text" id="nama_kategori" value="{{ isset($kategori->nama_kategori) ? $kategori->nama_kategori : ''}}" >
    {!! $errors->first('nama_kategori', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
