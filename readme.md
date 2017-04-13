# dummy content

Dummy functions for fast wireframing with placeholder content, using [dummyimage.com](http://www.dummyimage.com) and [randomtext.me](http://www.randomtext.me)

## Install

1. include php file
2. use functions

## available functions

### generic 

* `dummy::set_image_defaults(array( 'domain' => 'https://dummyimage.com',  
									'px' => '1920x1080', // pixel dimensions
									'bgcolor' => 'ff7c00', // background color
									'color' => 'fff', // font color
									'format' => 'png', // file format
									'alt' => 'dummy image', // image alt text
									'title' => 'dummy image title', // image title text
									'text' => '', // image text) )`

* `dummy::image($size = 'hd', $args = array(), $echo = true)`
* `dummy::figure($size = 'hd', $args = array(), $echo = true)`

* `dummy::text($args = array(
			'domain' => 'http://www.randomtext.me/api',
			'generator' => 'lorem', // lorem|gibberish
			'type' => 'p',
			'elements' => '5',
			'words' => '20-60',
		), $strip_tags = false)`

* `dummy::h1($args = array(), $strip_tags = false)`
* `dummy::h2($args = array(), $strip_tags = false)`
* `dummy::h3($args = array(), $strip_tags = false)`
* `dummy::h4($args = array(), $strip_tags = false)`
* `dummy::ol($args = array(), $strip_tags = false)`
* `dummy::ul($args = array(), $strip_tags = false)`
* `dummy::p($args = array(), $strip_tags = false)`
* `dummy::blockquote($args = array(), $strip_tags = false)`
* `dummy::table($dimensions = '4x5', $header = 'top', $args = array(), $strip_tags = true)`


### wordpress specific
* `dummy_the_post_thumbnail()`
* `dummy_the_title()`
* `dummy_the_excerpt()`
* `dummy_the_content()`


## history
* v1.0.0: basic functions