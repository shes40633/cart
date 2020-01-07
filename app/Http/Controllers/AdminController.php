<?php

namespace App\Http\Controllers;

use App\productimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function index()
    {

        return view('home');
    }
    public function ajax_upload_img(Request $request)
    {
        // A list of permitted file extensions
        $allowed = array('png', 'jpg', 'gif', 'zip');
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $allowed)) {
                echo '{"status":"error"}';
                exit;
            }
            $name = strval(time() . md5(rand(100, 200)));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            $destination = public_path() . '/upload/img/' . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo "/upload/img/" . $filename; //change this URL
        }
        exit;
    }

    public function ajax_delete_img(Request $request)
    {
        if (file_exists(public_path() . $request->file_link)) {
            File::delete(public_path() . $request->file_link);
        }
    }



    public function ajax_delete_productimg(Request $request)
    {
        $productimg_id = $request->productimgs;
        $productimg = productimg::where('id', $productimg_id)->first();
        $img = '/storage/'.$productimg->imges;

        if (file_exists(public_path() . $img)) {
            File::delete(public_path() . $img);
        }
        $productimg->delete();
    }
}
