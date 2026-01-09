@csrf

<div class="mb-3">
    <label>Resource Type</label>
    <select name="resource_type" class="form-control">
        <option value="video" {{ old('resource_type', $tutorial->resource_type ?? '') == 'video' ? 'selected' : '' }}>Video</option>
        <option value="pdf">PDF</option>
    </select>
</div>

<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $tutorial->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Sub Title</label>
    <input type="text" name="sub_title" class="form-control"
           value="{{ old('sub_title', $tutorial->sub_title ?? '') }}">
</div>

<div class="mb-3">
    <label>Video URL</label>
    <input type="url" name="url" class="form-control"
           value="{{ old('url', $tutorial->url ?? '') }}" required>
</div>

<button class="btn btn-success">Save</button>
