<?php
//include 'editor.html';
$html = file_get_contents('editor.html');

//search for html files in demo and my-pages folders
//$htmlFiles = glob('{my-pages/*.html,demo/*\/*.html, demo/*.html}',  GLOB_BRACE);
$htmlFiles = glob('{templates/*/*\/*.html,myapps/*\/*.html}', GLOB_BRACE);
$files = '';
foreach ($htmlFiles as $file) {
  if (in_array($file, array('new-page-blank-template.html', 'editor.html')))
    continue; //skip template files


  $pathInfo = pathinfo($file);
  $filename = $pathInfo['filename'];
  $folder = basename($pathInfo['dirname']);

  $subfolders = explode('/', trim($pathInfo['dirname'], '/'));
  $filename = end($subfolders);
  if (count($subfolders) > 1 && $filename != "index") {
    $name = explode('/', $pathInfo['filename'])[0];
    if (strpos($name, '.') !== false){

      $name = explode('.', $name)[0];
    }

  } else {
    $name = $filename;

  }



  $url = $pathInfo['dirname'] . '/' . $pathInfo['basename'];
  $title = ucfirst($name);

  $files .= "{name:'$name', file:'$file', title:'$title',  url: '$url', folder:'$folder'},";
}


//replace files list from html with the dynamic list from demo folder
$html = str_replace('(pages);', "([$files]);", $html);

echo $html;
