@csrf
<div class="form-group ">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name"
           class="form-control  @error('name') is-invalid @enderror"
           placeholder="Naam"
           minlength="3"
           required
           value="{{ old('naam', $pump->pumpname ?? '') }}">

    <label for="location">Locatie</label>
    <input type="text" name="location" id="location"
           class="form-control  @error('location') is-invalid @enderror"
           placeholder="Locatie"
           minlength="3"
           required
           value="{{ old('location', $pump->location ?? '') }}">
    @error('name')



    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-success">Pomp opslaan</button>
