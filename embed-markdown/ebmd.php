<?php

/*
  Plugin Name: Embed-Markdown
  Description: Supplies the Shortcode: [embed_markdown url="https://raw.githubusercontent.com/KornSW/WP-EmbedMarkdown/master/README.md"]
  Author: Tobias Korn
  Version: 1.1.0 / 19.06.2021
 */

add_shortcode('embed_markdown', 'embed_markdown_shortcode');

function embed_markdown_shortcode($atts)
{
  $atts = array_change_key_case((array) $atts, CASE_LOWER);

  require_once('Parsedown.php');

  $mdic_atts = shortcode_atts(array(
    'url' => 'https://raw.githubusercontent.com/KornSW/WP-EmbedMarkdown/master/README.md'
  ), $atts);

  $Parsedown = new Parsedown();
  
  $url = $mdic_atts['url'];
  $content = file_get_contents($url);
  $directoryUrl = dirname($url).'/';
  $parsedUrl = parse_url($url);
  $baseUrl = $parsedUrl['scheme']."://".$parsedUrl['host'].'/';
  
  $mdContent = $Parsedown->text($content);
  
  $mdContent = str_replace('src="/', 'src="'.$baseUrl ,$mdContent);
  
  //prepend './' to any url (this is the only way to get relative urls like "subdir/img.png")
  $mdContent = str_replace('src="', 'src="./', $mdContent);
  
  //repair relative urls which already hat a '.' or '..'
  $mdContent = str_replace('src="./.', 'src=".', $mdContent);
  
  //repair urls which were rooted...
  $mdContent = str_replace('src="./http:', 'src="http:', $mdContent);
  $mdContent = str_replace('src="./https:', 'src="https:', $mdContent);
  
  //for the rest (all other urls) we can now prepent the source dir as fixpoint..
  $mdContent = str_replace('src=".', 'src="'.$directoryUrl.'.' ,$mdContent);


  return "<!--\n       OUTPUT OF TK EMBED-MARKDOWN 1.1.0\n\n       FROM: ".$url."\n\n-->".$mdContent;
}
?>