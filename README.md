

# About

This is a **plugin for Wordpress**, which **registers a Shortcode** to be used like this:

```
[embed_markdown url="https://raw.githubusercontent.com/KornSW/WP-EmbedMarkdown/master/README.md"]
```

WP will render the external Markdown into your site on the Position where the Shortcode is located. Since version 1.1. any relative URLs for embedded images within the MD will be converted to absolute urls (also supporting relative navigations like '..\\').

This plugin is the perfect solution when using github as primary store for a small documentation which have to be displayed additionally on a website. 

#### PLEASE NOTE:

* It is mostly **based on** the great ['**Parsedown**'](https://github.com/erusev/parsedown/) MD to HTML transformator from [erusev](https://github.com/erusev) - thanx to him!

* Just like parsedown is also this plugin distributed under the '**MIT License**'!



## Installation

Just copy the 'embed-markdown' folder into the  '**wp-content\plugins\\**' directory of your Wordpress-Installation...

