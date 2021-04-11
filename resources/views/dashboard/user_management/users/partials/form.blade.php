<label for="name" class="form-label">Name</label>
<input type="text" class="form-control mb-1" name="name" id="name" placeholder="Name of user" value="@if(old('name')){{old('name')}}@elseif(isset($user->name)){{$user->name}}@endif" required>

<label for="email" class="form-label">Email</label>
<input type="email" class="form-control mb-1" name="email" id="email" placeholder="User's email" value="@if(old('email')){{old('email')}}@elseif(isset($user->email)){{$user->email}}@endif" required>

<label for="password" class="form-label">Password</label>
<input type="password" class="form-control mb-1" name="password" id="password">

<label for="password_confirmation" class="form-label">Password confirmation</label>
<input type="password" class="form-control mb-1" name="password_confirmation" id="password_confirmation">


<label for="role" class="form-label">Role</label>
<select name="role" id="role" class="custom-select mb-1">
    @if($user)
        @include('dashboard.user_management.users.partials.user-isset', ['allRoles' => $allRoles])
    @else
        @include('dashboard.user_management.users.partials.user-not-isset', ['allRoles' => $allRoles])
    @endif
</select>

<label for="sectors" class="form-label">Sectors access</label>
<select name="sectors[]" id="sectors" class="custom-select mb-1" multiple>
    @include('dashboard.user_management.users.partials.sectors', ['sectors' => $sectors])
</select>
<hr>
<input type="submit" class="btn btn-primary" value="Save">
<input type="button" class="btn btn-primary button-redirect" data-redirect="{{route('dashboard.user_management.user.index')}}" value="Cancel">
