<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{



    public function store(Request $request)
    {

        $user = Auth::user();

        $folderName = $request->folder;

        $path = Storage::disk('public')->makeDirectory($folderName);

        $data = [
            'f_name' => $request->folder,
            'user_id' => $user->id,
            'f_path' => $path,
        ];

        DB::table('folders')->insert($data);

        return redirect("/dashboard");
    }
}
