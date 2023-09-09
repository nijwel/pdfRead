<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class PdfController extends Controller
{   

    public function pdfUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);
  
        $fileName = 'sample-demo'.'.'.$request->file->extension();  
   
        $request->file->move(public_path('/'), $fileName);
   
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
    }

    public function pdfRead(Request $request)
    {   
        $input = $request->text;

        $path = 'H:\laragon\bin\git\mingw64\bin\pdftotext.exe';
        $text = Pdf::getText(public_path('sample-demo.pdf'), $path);
        if($input){
           $search = stristr($text , $input);

           if($search){
            $text = strtok($search, " ");
           }else{
            $text = "No result found!";
           }
       }else{
            $text = Pdf::getText(public_path('sample-demo.pdf'), $path);
       }
        
        return view('pdf',compact('text'));
    }
}
