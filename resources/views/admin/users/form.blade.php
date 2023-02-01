@csrf
<div class="form-group ">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name"
           class="form-control  @error('name') is-invalid @enderror"
           placeholder="Naam"
           minlength="3"
           required
           value="{{ old('naam', $user->name ?? '') }}">

    <label for="name">Email</label>
    <input type="text" name="email" id="email"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="Email"
           minlength="3"
           required
           value="{{ old('email', $user->email ?? '') }}">


    <label for="password">Wachtwoord</label>
    <input type="password" name="password" id="password"
           class="form-control @error('password') is-invalid @enderror"
           placeholder="Wachtwoord"
           required
           value="{{ old('password', $user->password ?? '') }}">

    @csrf
    <label for="admin">Admin</label>
    <br>
{{--    <input type="checkbox" name="admin" value="1" {{ $user->admin ? 'checked' : '' }}>--}}
{{--    <input type="hidden" name="admin" value="0">--}}
    <input type="hidden" name="admin" value="0">
    <input type="checkbox" name="admin" value="1" {{ $user->admin ? 'checked' : '' }}>
    @error('name')



    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" style="background-color:#4D9B24" class="btn btn-success">Gebruiker opslaan</button>
