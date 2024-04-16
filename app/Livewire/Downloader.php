<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\DocumentLayout;
use PhpOffice\PhpPresentation\Shape\Drawing;
use PhpOffice\PhpPresentation\IOFactory;
use Illuminate\Support\Facades\Log;


class Downloader extends Component
{
    public $url;
    public $increment = 'a';
    public $isLoading = false;

    public function render()
    {
        return view('livewire.downloader');
    }

    public function download()
    {
        $this->validate([
            'url' => 'required|url'
        ]);

        $url = $this->url;
        $this->isLoading = true;

        //url will return html content of the page
        $html = file_get_contents($url);
        
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        
        //get title of the page
        $title = $dom->getElementsByTagName('title')->item(0)->nodeValue;

        //get image inside id="new-player
        $parents = $dom->getElementById('new-player');
        $imageTags = $parents->getElementsByTagName('img');
        // get the number of pages count node of imagetags above
        $pages = $imageTags->length;

        //get first node of the image
        $imageTag = $imageTags->item(0);
        //get src attribute of the image
        $dirtyImagesUrl = $imageTag->getAttribute('srcset');
        $imageUrlArray = explode(',', $dirtyImagesUrl);
        // get the last image dirty url for best quality
        $imageUrl = end($imageUrlArray);
        // get original url
        $imageUrl = explode(' ', $imageUrl)[1];

        // get the images url
        $imagesUrl = $this->getImagesUrl($imageUrl, $pages);

        // generate ppt
        // dd($imagesUrl);
        $filePath = $this->generatePpt($imagesUrl, $title);

        $respone = response()->download($filePath, basename($filePath))->deleteFileAfterSend(true);

        $this->url = '';
        $this->isLoading = false;
        
        return $respone;
    }

    public function getImagesUrl($url, $pages)
    {
        // example url params
        // https://image.slidesharecdn.com/theartificialintelligentrush-vdef-18102017-171024091237/85/the-ai-rush-1-2048.jpg?cb=1709991546

        $imagesUrl = [];
        
        for($i = 1; $i <= $pages; $i++){
            $urlLength = strlen($url);

            // this value is dynamic based on slideshare url
            $firstPart = substr($url, 0, $urlLength - 10);
            $secondPart = substr($url, $urlLength - 9);
            
            $imageUrl = $firstPart . $i . $secondPart;
            Log::info("Iteration $i: firstPart = $firstPart, secondPart = $secondPart, imageUrl = $imageUrl");
            $imagesUrl[] = $imageUrl;
        }

        return $imagesUrl;
    }

    public function generatePpt($imagesUrl, $title = 'Untitled')
    {
    
        $ppt = new PhpPresentation();
        $ppt->getLayout()->setDocumentLayout(DocumentLayout::LAYOUT_SCREEN_16X9);

        // remove the default slide
        $ppt->removeSlideByIndex(0);

        $imageUrl = 'https://image.slidesharecdn.com/theartificialintelligentrush-vdef-18102017-171024091237/75/the-ai-rush-1-2048.jpg?cb=1709991546';

        foreach($imagesUrl as $imageUrl){
            $currentSlide = $ppt->createSlide();
            // Fetch the image data from the URL
            $imageData = file_get_contents($imageUrl);
            // Convert the image data to a base64-encoded string
            $base64Image = base64_encode($imageData);

            $shape = new Drawing\Base64();
            $shape->setName('Image Base64')
                ->setDescription('Image Base64')
                ->setData('data:image/jpeg;base64,' . $base64Image)
                ->setResizeProportional(false)
                ->setHeight(540)
                ->setWidth(960)
                ->setOffsetX(0)
                ->setOffsetY(0);
            $currentSlide->addShape($shape);
        }

        // Sanitize the title for use as a file name
        $sanitizedTitle = preg_replace('/[^A-Za-z0-9_-]/', '_', $title);
        $outputFilePath = storage_path('app/public/' . $sanitizedTitle . '.pptx');

        // Define the output file path and save the presentation
        $outputFilePath = $sanitizedTitle . '.pptx';
        $writer = IOFactory::createWriter($ppt, 'PowerPoint2007');
        $writer->save($outputFilePath); 

        return $outputFilePath;
    }

}
