

<div class="container">
    <textarea 
    wire:model.defer="comment" 
    name="comment"
    id="write-comment"
    placeholder="{{ __('Comment') }}" 
    class="resize-none border-gray-400 container lg rounded ">
    </textarea>

    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded my-2"
    wire:click="addComment"
    id="add-comment">
        {{__('Comment')}}
    </button>
</div>


<script type="text/javascript">

    var comment = document.getElementById('write-comment') , 
    add_comment = document.querySelector('#add-comment')

    add_comment.style.display = "none"

    comment.onkeyup = function () {

        add_comment.style.display = this.value.trim().length ? "block" : "none"
        
    }

</script>


