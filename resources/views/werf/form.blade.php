@csrf
<div class="form-group ">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name"
           class="form-control  @error('name') is-invalid @enderror"
           placeholder="Naam"
           minlength="3"
           required
           value="{{ old('naam', $werf->name ?? '') }}">

    @csrf
    <label for="admin">Frequentiegestuurde pompen</label>
    <br>
    <input type="hidden" name="admin" value="0">
    <input type="checkbox" name="admin" value="1">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-success">Werf opslaan</button>
