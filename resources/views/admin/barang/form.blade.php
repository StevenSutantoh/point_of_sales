<div class="form-group {{ $errors->has('kode_barang') ? 'has-error' : ''}}">
    <label for="kode_barang" class="control-label">{{ 'Kode Barang' }}</label>
    <input class="form-control" name="kode_barang" type="text" id="kode_barang" value="{{ isset($barang->kode_barang) ? $barang->kode_barang : ''}}" >
    {!! $errors->first('kode_barang', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('kode_kategori') ? 'has-error' : ''}}">
    <label for="kode_kategori" class="control-label">{{ 'Kode Kategori' }}</label>
    <input class="form-control" name="kode_kategori" type="text" id="kode_kategori" value="{{ isset($barang->kode_kategori) ? $barang->kode_kategori : ''}}" >
    {!! $errors->first('kode_kategori', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nama_barang') ? 'has-error' : ''}}">
    <label for="nama_barang" class="control-label">{{ 'Nama Barang' }}</label>
    <input class="form-control" name="nama_barang" type="text" id="nama_barang" value="{{ isset($barang->nama_barang) ? $barang->nama_barang : ''}}" >
    {!! $errors->first('nama_barang', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('merk') ? 'has-error' : ''}}">
    <label for="merk" class="control-label">{{ 'Merk' }}</label>
    <input class="form-control" name="merk" type="text" id="merk" value="{{ isset($barang->merk) ? $barang->merk : ''}}" >
    {!! $errors->first('merk', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('kuantitas') ? 'has-error' : ''}}">
    <label for="kuantitas" class="control-label">{{ 'Kuantitas' }}</label>
    <input class="form-control" name="kuantitas" type="text" id="kuantitas" value="{{ isset($barang->kuantitas) ? $barang->kuantitas : ''}}" >
    {!! $errors->first('kuantitas', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('harga_beli') ? 'has-error' : ''}}">
    <label for="harga_beli" class="control-label">{{ 'Harga Beli' }}</label>
    <input class="form-control" name="harga_beli" type="number" id="harga_beli" value="{{ isset($barang->harga_beli) ? $barang->harga_beli : ''}}" >
    {!! $errors->first('harga_beli', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('harga_jual') ? 'has-error' : ''}}">
    <label for="harga_jual" class="control-label">{{ 'Harga Jual' }}</label>
    <input class="form-control" name="harga_jual" type="number" id="harga_jual" value="{{ isset($barang->harga_jual) ? $barang->harga_jual : ''}}" >
    {!! $errors->first('harga_jual', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('stok') ? 'has-error' : ''}}">
    <label for="stok" class="control-label">{{ 'Stok' }}</label>
    <input class="form-control" name="stok" type="text" id="stok" value="{{ isset($barang->stok) ? $barang->stok : ''}}" >
    {!! $errors->first('stok', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
