<div class="mt-2">
    <input id="input-link" value="https://www.slideshare.net/marketingartwork/ai-trends-in-creative-operations-2024-by-artwork-flowpdf" type="text" class="w-full rounded-md p-2 bg-gray-200 text-gray-800 focus:border-yellow-600" placeholder="enter link here ">
    {{ $increment }}
    <div class="grid grid-cols-2 gap-2">
        <button id="clear" class="col-span-1 bg-gray-600 text-gray-100 font-semibold p-2 rounded-md mt-2">Clear</button>
        <button wire:click="download" class="col-span-1 bg-gray-600 text-gray-100 font-semibold p-2 rounded-md mt-2">Download</button>
    </div>
</div>
