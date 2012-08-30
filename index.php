<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <style type="text/css">
      body {
        background: #fff;
        margin: 20px 20px;
        width: 400px;
        line-height:1;
      }
      body * {
       /* text-align: justify; */
      }
    </style>
  </head>
  <body>
<?php
include('assets/php-typography/php-typography.php');
function array_random($arr, $num = 1) {
  shuffle($arr);
  $r = array();
  for ($i = 0; $i < $num; $i++) {
    $r[] = $arr[$i];
  }
  return $num == 1 ? $r[0] : $r;
}
$files = glob('posts/*.rst');

rsort($files);

foreach($files as $file) {
  echo "<b>" . 
    \ preg_replace("/^\w+/", "\\0,", 
    \ str_replace("posts/", "", 
    \ str_replace(":rst", "", 
    \ str_replace("-", " @ ", 
    \ str_replace(":AM"," am", 
    \ str_replace(":PM"," pm", 
    \ str_replace(".",":", 
    \ str_replace("_", " ", $file)
    )
    )
    )
    )
    )
    )
    ) . "</b>";
  $html = shell_exec("rst2html2 $file");
  $typo = new phpTypography();
  $html = $typo->process($html);
  echo $html;
  echo "<hr />";
}
?>

This is a small blog by Chris Truett.

  </body>
</html>
