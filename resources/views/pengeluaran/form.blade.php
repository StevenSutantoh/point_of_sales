<div class="form-group {{ $errors->has('tanggal') ? 'has-error' : ''}}">
    <label for="tanggal" class="control-label">{{ 'Tanggal' }}</label>
    <input class="form-control" name="tanggal" type="datetime-local" id="tanggal" value="{{ isset($pengeluaran->tanggal) ? $pengeluaran->tanggal : ''}}" >
    {!! $errors->first('tanggal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : ''}}">
    <label for="deskripsi" class="control-label">{{ 'Deskripsi' }}</label>
    <input class="form-control" name="deskripsi" type="text" id="deskripsi" value="{{ isset($pengeluaran->deskripsi) ? $pengeluaran->deskripsi : ''}}" >
    {!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nominal') ? 'has-error' : ''}}">
    <label for="nominal" class="control-label">{{ 'Nominal' }}</label>
    <input class="form-control" name="nominal" type="number" id="nominal" value="{{ isset($pengeluaran->nominal) ? $pengeluaran->nominal : ''}}" >
    {!! $errors->first('nominal', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
