



<?php  
function generate_html_page ($h1, $title) {
  $html = <<<HTML
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>$title en PHP</title>
  </head>
  <body>
    <h1>$h1</h1>
  </body>
</html>
HTML;
  echo $html;
}

?>
