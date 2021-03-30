<label for="name" class="form-label">Name</label>
<input type="text" class="form-control mb-1" name="name" id="name" placeholder="Name of company" value="@if(old('name')){{old('name')}}@elseif(isset($company->name)){{$company->name}}@endif" required>

<label for="phone" class="form-label">Phone</label>
<input type="text" class="form-control mb-1" name="phone" id="phone" placeholder="Phone of company" value="@if(old('phone')){{old('phone')}}@elseif(isset($company->phone)){{$company->phone}}@endif">

<label for="email" class="form-label">Email</label>
<input type="email" class="form-control mb-1" name="email" id="email" placeholder="Email of company" value="@if(old('email')){{old('email')}}@elseif(isset($company->email)){{$company->email}}@endif" required>


<label for="sectors" class="form-label">Parent sector</label>
<select name="sectors[]" id="sectors" class="custom-select mb-1" multiple>
    <option value="">-- No parent sector --</option>
    @include('dashboard.companies.partials.sectors', ['sectors' => $sectors])
</select>
<hr>
<input type="submit" class="btn btn-primary" value="Save">
