<?php

namespace App\Http\Controllers;

//use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ContentController extends Controller
{

    //store uploaded content
    public function store(Request $request) {
        $content = $request->file('file');
        if(!$content) {
            return back()->with('error','no file uploaded');
        }
        $originalName = $content->getClientOriginalName();
        $userId = auth()->user()->id;
        $path = $content->storeAs($userId,$originalName,'public');
        return back()->with('success','file uploaded successfully');
    }

    //manage page -> view content
    public function manage() {
        $id = auth()->user()->id;
        $files = Storage::disk('public')->files($id);
        $fileList = collect($files)->map(function($file) {
            return [
                'name' => basename($file),
                'url' => Storage::url($file),
            ];
        });

        return view('manage_content', compact('fileList'));   
    }

    //deleting content
    public function remove(Request $request) {
        $path = $request->query('file');
        $relativePath = str_replace('/storage/','', $path);
        Storage::disk('public')->delete($relativePath);
        return back()->with('success','removed');   
    }
}