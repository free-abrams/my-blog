<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class UploadController extends Controller
{
	
	public function upload(Request $request)
	{
		$files = $request->file();
		
		$urls = [];
		foreach ($files as $file) {
			$urls[] = env('ALIOSS_HOST').'/'.\Storage::disk('oss')->put('', $file);
		}
		
		return Response::json([
			'errno' => 0,
			'data' => $urls
		]);
	}
}
