<?php

namespace App\Http\Controllers;

use App\Libraries\Ultilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CkeditorController extends Controller
{
    /**
     * success response method.
     * Author: Tien Phat
     * date: 21/1/2021
     */
    public function upload(Request $request):void
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('uploads'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = '/uploads/'.$fileName;
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
