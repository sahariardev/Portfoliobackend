<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use  App\Http\Resources\Gallery as GalleryResource;
class PageController extends Controller
{
    

    public function showPage(Gallery $gallery)
    {
        dd($gallery);
        //return new GalleryResource(Gallery::find(1)) ;
    }
}
