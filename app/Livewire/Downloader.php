<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Downloader extends Component
{
    public $url;
    public $increment = 0;

    public function render()
    {
        return view('livewire.downloader');
    }

    public function download()
    {
        $this->increment++;

        $url = "https://www.slideshare.net/marketingartwork/ai-trends-in-creative-operations-2024-by-artwork-flowpdf";


        //url will return html content of the page
        $html = file_get_contents($url);
        
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $images = [];
        
        //get image inside id="new-player
        $imageTags = $dom->getElementsByTagName('img');
        

        dd($imageTags);
        
        dd($html);

    
    }

    public function getImagesUrl($url, $pages)
    {
        // example url
        // https://image.slidesharecdn.com/theartificialintelligentrush-vdef-18102017-171024091237/85/the-ai-rush-1-2048.jpg?cb=1709991546
        $imagesUrl = [];
        
        for($i = 1; $i <= $pages; $i++){
            $urlLength = strlen($url);

            $firstPart = substr($string, 0, $urlLength - 24);
            $secondPart = substr($string, -23);
           
            $imageUrl = $firstPart . $page . $secondPart;     
            $imagesUrl[] = $imageUrl;

        }
    }
}
