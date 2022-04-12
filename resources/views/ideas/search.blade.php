<h4 class="title text-center">SEARCH</h4>
<div class="card my-lg-3">
    <div class="card-body ">
        <form action="">
            <div>
                <label class="form-label" for="searchUsingKey">Key:</label>
                <input type="search" class="form-control" id="searchUsingKey" aria-describedby="search-addon" name="search" value="{{ request()->input('search') }}">
            </div>
            <div style="padding: 10px 0px 0px 0px;">
                <label for="selectMission" class="form-label">Mission:</label>
                <select class="form-select" id="selectMission" name="mission_id">
                    <option value="0">All</option>
                    @foreach($all_missions as $mission)
                    @if ($request->mission_id == $mission->id)
                    <option value="{{ $mission->id }}" selected>{{ $mission->name }}</option>
                    @else
                    <option value="{{ $mission->id }}">{{ $mission->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div style="padding: 10px 0px 0px 0px;">
                <label for="selectFilter" class="form-label">Filter:</label>
                <select class="form-select" id="selectFilter" name="filter" value="{{ request()->get('filter') }}">
                    @switch($request->filter)
                    @case('views')
                    <option value="views" selected>Descending views</option>
                    <option value="likes">Descending likes</option>
                    <option value="dislikes">Descending dislikes</option>
                    <option value="comments">Descending comments</option>
                    <option value="recently">Descending recently</option>
                    <option value="none">None</option>
                    @break
                    @case('likes')
                    <option value="views">Descending views</option>
                    <option value="likes" selected>Descending likes</option>
                    <option value="dislikes">Descending dislikes</option>
                    <option value="comments">Descending comments</option>
                    <option value="recently">Descending recently</option>
                    <option value="none">None</option>
                    @break
                    @case('dislikes')
                    <option value="views">Descending views</option>
                    <option value="likes">Descending likes</option>
                    <option value="dislikes" selected>Descending dislikes</option>
                    <option value="comments">Descending comments</option>
                    <option value="recently">Descending recently</option>
                    <option value="none">None</option>
                    @break
                    @case('comments')
                    <option value="views">Descending views</option>
                    <option value="likes">Descending likes</option>
                    <option value="dislikes">Descending dislikes</option>
                    <option value="comments" selected>Descending comments</option>
                    <option value="recently">Descending recently</option>
                    <option value="none">None</option>
                    @break
                    @case('recently')
                    <option value="views">Descending views</option>
                    <option value="likes">Descending likes</option>
                    <option value="dislikes">Descending dislikes</option>
                    <option value="comments">Descending comments</option>
                    <option value="recently" selected>Descending recently</option>
                    <option value="none">None</option>
                    @break
                    @default
                    @case('none')
                    <option value="views">Descending views</option>
                    <option value="likes">Descending likes</option>
                    <option value="dislikes">Descending dislikes</option>
                    <option value="comments">Descending comments</option>
                    <option value="recently">Descending recently</option>
                    <option value="none" selected>None</option>
                    @endswitch
                </select>
            </div>
            <div style="padding: 15px 0px 0px 0px;">
                <center><button class="btn btn-success d-grid" type="submit">Search</button></center>
            </div>
        </form>
    </div>
</div>