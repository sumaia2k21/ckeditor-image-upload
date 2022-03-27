<?php

namespace App\Http\Controllers;

use App\Models\Image as ModelsImage;
use Illuminate\Http\Request;
use Image;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function post()
    {
        return view('post');
    }
    public function post_store(Request $request)
    {
        echo $request->input('description');
    }
    public function upload(Request $request)

    {

        if($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);

            $extension = $request->file('upload')->getClientOriginalExtension();

            $fileNametostore = $fileName.'_'.time().'.'.$extension;

        

            $request->file('upload')->storeAs('public/uploads', $fileName);
            $request->file('upload')->storeAs('public/uploads/thumbnail', $fileNametostore);
            
            $thumbnailpath = public_path('storage/uploads/thumbnail',$fileNametostore);
            $img =ModelsImage::make($thumbnailpath)->resize(500,150,function($constraint)
            {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
            echo json_encode([
                'default'=> asset('storage/uploads/'.$fileNametostore),
                '500'=> asset('storage/uploads/thumbnail/'.$fileNametostore)
            ]);

        }

    }
}
