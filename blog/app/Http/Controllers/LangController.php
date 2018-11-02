<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
	public function lang(Request $request)
	{
		Session::put('locale', $request->lang);
		
		return redirect()->back();
	}
}
