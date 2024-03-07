<div class="card-body">
    <div class="form-group row m-1">
        <label for="title" class="col-sm-2 mt-1 form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" placeholder="Title"
                value="{{ old('title', $job->title ?? '') }}"
                {{-- value="@if($job->title){{ $job->title }}@endif" --}}
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>
    <div class="form-group row m-1">
        <label for="post" class="col-sm-2 mt-1 form-label">Post</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="post" placeholder="Post"
                {{-- value="@if($job->post){{ $job->post }}@endif" --}}
                value="{{ old('post', $job->post ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>
    <div class="form-group row m-1">
        <label for="description" class="col-sm-2 mt-1 form-label">Description</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" name="description" placeholder="Description"
                {{-- value="@if($job->description){{ $job->description }}@endif" --}}
                value="{{ old('description', $job->description ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif
            ></textarea>
        </div>
    </div>

    <div class="form-group row m-1">
        <label for="salary_min" class="col-sm-2 mt-1 form-label">Salary</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="salary_min" placeholder="Min Salary"
                {{-- value="@if($job->salary_min){{ $job->salary_min }}@endif" --}}
                value="{{ old('salary_min', $job->salary_min ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>

        {{-- <label for="salary_max" class="col-sm-2 mt-1 form-label">Max Salary</label> --}}
        <div class="col-sm-5">
            <input type="text" class="form-control" name="salary_max" placeholder="Max Salary"
                {{-- value="@if($job->salary_max){{ $job->salary_max }}@endif" --}}
                value="{{ old('salary_max', $job->salary_max ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>
    <div class="form-group row m-1">
        <label for="vacancy" class="col-sm-2 mt-1 form-label">Vacancy</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="vacancy" placeholder="Vacancy"
                {{-- value="@if($job->vacancy){{ $job->vacancy }}@endif" --}}
                value="{{ old('vacancy', $job->vacancy ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>
    <div class="form-group row m-1">
        <label for="experience" class="col-sm-2 mt-1 form-label">Experience</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="experience" placeholder="Experience"
                {{-- value="@if($job->experience){{ $job->experience }}@endif" --}}
                value="{{ old('experience', $job->experience ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>

    <div class="form-group row m-1">
        <label for="link" class="col-sm-2 mt-1 form-label">Link</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="link" placeholder="Link"
                {{-- value="@if($job->link){{ $job->link }}@endif" --}}
                value="{{ old('link', $job->link ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>
    <div class="form-group row">
        <label for="ends_at" class="col-sm-2 col-form-label">Expiration Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="ends_at" placeholder="Expiration Date"
                {{-- value="@if($job->ends_at){{ $job->ends_at }}@endif" --}}
                value="{{ old('ends_at', $job->ends_at ?? '') }}"
                @if (Route::currentRouteName() == 'jobs.show') readonly @endif>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="tags" class="col-sm-2 col-form-label">Tags</label>
        <div class="col-sm-10">
            <select class="select2" multiple="multiple"
                name="tags[]" data-tags="true" placeholder="Tags"
                @if(Route::currentRouteName() == 'jobs.show') disabled @endif
                style="width: 100%;">
                @if(Route::currentRouteName() == 'jobs.edit')
                    @foreach($tags as $tag)
                        <option value="{{ $tag }}" @if(in_array($tag, $selectedTags)) selected @endif>{{ $tag->name }}</option>
                    @endforeach
                @elseif(Route::currentRouteName() == 'jobs.show')
                    @foreach($selectedTags as $tag)
                        <option value="{{ $tag }}" selected>{{ $tag }}</option>
                    @endforeach
                @else
                    @foreach($tags as $tag)
                        <option value="{{ $tag }}">{{ $tag }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<!-- /.card-body -->


<script>
    $(function() {
        $('input[name="ends_at"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('.select2').select2()
    });
</script>

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: darkcyan;
    }
</style>