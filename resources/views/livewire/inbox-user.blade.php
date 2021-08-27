

<div class='inbox-container'>

    <style>

        .sent-from {
            color : gray;
            display : inline-block;
        }

    </style>

    <script type="text/javascript">
        var decrypted_msgs = {}
    </script>

    @if (count($collector))

    <div id="inbox">

        @foreach($collector as $collect)

            @livewire('chat-person' , ['collect' => $collect])

        @endforeach 

    </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Chats') }}</p>
        </div>  

    @endif 
   
    
</div>






