

<script>

    function setStatus(userId){

        let user_status = document.getElementById(`user-status-${userId}`);
        user_status.textContent = "online";
        user_status.style.color = "green";

        setTimeout(() => {
            user_status.textContent = "offline";
            user_status.style.color = "#000";
        }, 2 * 60 * 1000);

    }

</script>    


<div class="flex">

    <p id="<?php echo "user-status-" . $this->userId; ?>" class="text-sm font-bold">
        @if(Cache::has('user-active-' . $userId))
            <script>
                setStatus(<?php echo $this->userId; ?>)
            </script> 
        @else
            {{ __('offline') }}       
        @endif
    </p>

    <script type="module">

        Livewire.on(`user-online-${<?php echo $this->userId; ?>}`, () => {
            setStatus(<?php echo $this->userId; ?>)
        })

    </script>   

</div>





