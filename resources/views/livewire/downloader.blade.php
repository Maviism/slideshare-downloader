<div class="mt-2">
    <input id="input-link" wire:model="url" type="text" class="w-full rounded-md p-2 bg-gray-200 text-gray-800 focus:border-yellow-600" placeholder="enter slideshare link here ">
    @error('url')
        <p class="text-red-600 mt-2">{{ $message }}</p>
    @enderror
    <div class="grid grid-cols-2 gap-2">
        <button id="clear" class="col-span-1 bg-gray-600 text-gray-100 font-semibold p-2 rounded-md mt-2">Clear</button>
        <button wire:click="download" 
                wire:loading.attr="disabled" 
                wire:loading.class="animate-pulse bg-yellow-800"
                id="download"
                class="col-span-1 bg-gray-600 text-gray-100 font-semibold p-2 rounded-md mt-2">
                    Download 
        </button>
    </div>

    <div wire:loading>
        Loading....
    </div>

    @push('scripts')
        <script>
            document.getElementById('input-link').addEventListener('input', function() {
            let input = document.getElementById('input-link').value;
            let clear = document.getElementById('clear');
            let download = document.getElementById('download');
            if (input === '') {
                clear.classList.add('bg-gray-600');
                clear.classList.remove('bg-red-600');
                clear.disabled = true;
                download.classList.add('bg-gray-600');
                download.classList.remove('bg-yellow-600');
                download.disabled = true;
            } else {
                clear.classList.add('bg-red-600');
                clear.classList.remove('bg-gray-600');
                clear.disabled = false;
                download.classList.add('bg-yellow-600');
                download.classList.remove('bg-gray-600');
                download.disabled = false;
            }
        });

        //clear button
        document.getElementById('clear').addEventListener('click', function() {
            document.getElementById('input-link').value = '';
            document.getElementById('clear').classList.add('bg-gray-600');
            document.getElementById('clear').classList.remove('bg-red-600');
            document.getElementById('clear').disabled = true;
            document.getElementById('download').classList.add('bg-gray-600');
            document.getElementById('download').classList.remove('bg-yellow-600');
            document.getElementById('download').disabled = true;
        });
        </script>
    @endpush
</div>
