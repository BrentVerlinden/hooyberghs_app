@csrf
<div class="form-group ">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name"
           class="form-control  @error('name') is-invalid @enderror"
           placeholder="Naam"
           minlength="3"
           required
           value="{{ old('naam', $werf->name ?? '') }}">

    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-success">Werf opslaan</button>
