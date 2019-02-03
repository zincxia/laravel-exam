<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30
 * Time: 15:28
 */

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Base
{
    public function WangEditorImageUpload(Request $request)
    {
        $path = Storage::disk('local')->putFile('images', $request->file('img'));
        $p = '/app/' . $path;
        return response()->json(['errno' => 0, 'data' => [$p]]);
    }

    public function SummernoteImageUpload(Request $request)
    {
        $path = Storage::disk('admin')->putFile('images', $request->file('file'));
        $p = '/' . $path;
        return response()->json($p);
    }
}