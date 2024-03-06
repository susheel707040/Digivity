<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormData extends Controller
{
   public function index(Request $request)
  {
      echo "For Use Module";
      foreach ($request->all() as $key=>$value) {

       echo '"'.$key.'",<br/>';

      }

      echo "<br/><br/>For Use Request<br/><br/>";

      foreach ($request->all() as $key=>$value) {

          echo "'$key' => ['sometimes'], <br/>";

      }

  }
}
