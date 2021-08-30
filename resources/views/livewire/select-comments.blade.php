

<div id="comments-selector" name="recents" wire:model="recents" >

    <select class="comments-selector mb-4">
        <option value="">Comments</option>
        <option value="recent">Recent Comments</option>
        <option value="all">All Comments</option>
    </select>

    <small class="ml-4">
        {{ $category ? ($category == "all" ? __('All Comments') : __('Recent Comments')) : "" }}
    </small>

</div>


