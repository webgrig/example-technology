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
    @foreach($allRoles as $role)
        @if($user)
            @if(old('role') == $role->name)
                <option value="{{$role->name}}" selected>{{$role->name}}</option>
            @elseif(!old('role') && $user->hasAnyRole($role->name))
                <option value="{{$role->name}}" selected>{{$role->name}}</option>
            @else
                <option value="{{$role->name}}">{{$role->name}}</option>
            @endif
        @elseif(old('role') == $role->name)
            <option value="{{$role->name}}" selected>{{$role->name}}</option>
        @else
            <option value="{{$role->name}}">{{$role->name}}</option>
        @endif
    @endforeach
</select>


<hr>
<input type="submit" class="btn btn-primary" value="Save">
