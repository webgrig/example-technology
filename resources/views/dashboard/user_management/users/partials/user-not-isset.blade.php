@php $selectedFlag = false; @endphp
@foreach($allRoles as $role)
    @if(old('role'))
        @if(old('role') == $role->name)
            <option value="{{$role->name}}" @php if(!$selectedFlag){echo 'selected'; $selectedFlag = true;}@endphp >{{$role->name}}</option>@php continue; @endphp
        @endif
    @elseif($role->name == 'user')
        <option value="{{$role->name}}" @php if(!$selectedFlag)echo 'selected'; $selectedFlag = true; @endphp>{{$role->name}}</option>@php continue; @endphp
    @endif
    <option value="{{$role->name}}">{{$role->name}}</option>
@endforeach
