<label for="title" class="form-label">Title</label>
<input type="text" class="form-control mb-1" name="title" id="title" placeholder="Title of sector" value="@if(old('title')){{old('title')}}@elseif(isset($sector->title)){{$sector->title}}@endif" required>

<label for="parent_id" class="form-label">Parent sector</label>
<select name="parent_id" id="parent_id" class="custom-select mb-1">
    <option value="">-- Without parent category --</option>
    @include('dashboard.sectors.partials.sectors', ['sectors' => $sectors])
</select>
<hr>
<input type="submit" class="btn btn-primary" value="Save">
