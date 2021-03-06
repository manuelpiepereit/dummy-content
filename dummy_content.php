<?php 

/**
 * Dummy functions for fast wireframing with placeholder content
 *
 * @author 	Neonpastell GmbH, Manuel Piepereit
 * @version 1.1.1
 * @date    17/05/03
 *
 * available functions:
 *
 * dummy::set_image_defaults(array( 'domain' => 'https://dummyimage.com',
 *									'px' => '1920x1080', // pixel dimensions
 *									'bgcolor' => 'ff7c00', // background color
 *									'color' => 'fff', // font color
 *									'format' => 'png', // file format
 *									'alt' => 'dummy image', // image alt text
 *									'title' => 'dummy image title', // image title text
 *									'text' => '', // image text) )
 *
 * dummy::image($size = 'hd', $args = array(), $echo = true);
 * dummy::figure($size = 'hd', $args = array(), $echo = true);
 *
 * dummy::text($args = array(
 *			'domain' => 'http://www.randomtext.me/api',
 *			'generator' => 'lorem', // lorem|gibberish
 *			'type' => 'p',
 *			'elements' => '5',
 *			'words' => '20-60',
 *		), $strip_tags = false);
 *
 * dummy::h1($args = array(), $strip_tags = false);
 * dummy::h2($args = array(), $strip_tags = false);
 * dummy::h3($args = array(), $strip_tags = false);
 * dummy::h4($args = array(), $strip_tags = false);
 * dummy::ol($args = array(), $strip_tags = false);
 * dummy::ul($args = array(), $strip_tags = false);
 * dummy::p($args = array(), $strip_tags = false);
 * dummy::blockquote($args = array(), $strip_tags = false);
 * dummy::table($dimensions = '4x5', $header = 'top', $args = array(), $strip_tags = true) {
 *
 * dummy::inputs($echo = true);
 * dummy::selects($echo = true);
 * dummy::radios($echo = true);
 * dummy::checkboxes($echo = true);
 * dummy::button($label, $modifier_class = '', $echo = true);
 * dummy::form($supports = array('inputs', 'selects', 'radios', 'checkboxes', 'buttons'));
 *
 * for wordpress placeholders
 * dummy_the_post_thumbnail($size = 'hd', $args = array(), $echo = true);
 * dummy_the_title();
 * dummy_the_excerpt();	
 * dummy_the_content(array('intro', 'headings', 'paragraphs', 'lists', 'images', 'gallery', 'table', 'blockquote', 'address', 'form'));
 */





/**
 * wireframing helper functions 
 *
 * @author 	Neonpastell GmbH, Manuel Piepereit
 * @since   1.0.0
 * @date    17/04/06
 */
class dummy {

	// image default values
	private static $image_defaults = array(
			'domain' => 'https://dummyimage.com',
			'px' => '1920x1080', // pixel dimensions
			'bgcolor' => 'ff7c00', // background color
			'color' => 'fff', // font color
			'format' => 'png', // file format
			'alt' => 'dummy image', // image alt text
			'title' => 'dummy image title', // image title text
			'text' => '', // image text
		);


	/**
	 * set new image defaults
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$args (array) an array of arguments
	 * @return  n/a
	 */
	public static function set_image_defaults($args) {
		// merge arrays
		self::$image_defaults = array_merge(self::$image_defaults, $args);
	}


	/**
	 * creates a dummy image from https://dummyimage.com/
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$size (string) predefined sizes
	 * @param 	$args (array) an array of arguments
	 * @param 	$echo (bool) if image is echoed or url is returned
	 * @return  string
	 */
	public static function image($size = 'hd', $args = array(), $echo = true) {
		// merge arrays
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge(self::$image_defaults, $args);

		// create image size
		switch ($size) {
			case 'thumbnail':
				$args['px'] = '200x200';
				break;
			case 'square':
			case '1:1':
				$args['px'] = '1000x1000';
				break;
			case 'small':
				$args['px'] = '854x480';
				break;
			case 'medium':
			case '720p':
				$args['px'] = '1280x720';
				break;
			case 'large':
			case 'hd':
			case '1080p':
			case '16:9':
				$args['px'] = '1920x1080';
				break;
			case 'huge':
			case 'uhd':
				$args['px'] = '2560x1440';
				break;

			case '4:3':
				$args['px'] = '1280x960';
				break;
			case 'portrait':
			case '3:4':
				$args['px'] = '960x1280';
				break;
			default:
				$args['px'] = $size;
				break;
		}
		// fallback size
		if (!$size) {
			$args['px'] = '1920x1080';
		}

		// create url
		$url = $args['domain'] . '/' . $args['px'] . '/' . $args['bgcolor'] . '/' . $args['color'] . '.' . $args['format'];
		
		// add optional text
		$url .= ($args['text'] != '') ? '&text='.$args['text'] : '';
		
		// echo or return
		if ($echo) {
			echo '<img src="'.$url.'" alt="'.$args['alt'].'" title="'.$args['title'].'" />';
		} else {
			return $url;
		}
	}

	/**
	 * creates a figure element
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$size (string) predefined sizes
	 * @param 	$args (array) an array of arguments
	 * @param 	$echo (bool) if image is echoed or url is returned
	 * @return  string
	 */
	public static function figure($size = 'medium', $args = array(), $echo = true) {
		$figimage = self::image($size, $args, false);
		$figcaption = self::text(array('type' => 'h1', 'elements' => '', 'words' => '3-10' ), true);
		$text_out = '<figure role="group"><img src="'.$figimage.'" alt="dummy image" title="dummy image title"><figcaption>'.$figcaption.'</figcaption></figure>';
		echo $text_out;	
	}



	
	/**
	 * creates text elements from http://www.randomtext.me/
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$args (array) arguments for text generation
	 * @param 	$strip_tags (bool) if html tags are stripped from result
	 * @return  string
	 */
	public static function text($args = array(), $strip_tags = false) {
		// set defaults
		$default_args = array(
			'domain' => 'http://www.randomtext.me/api',
			'generator' => 'lorem', // lorem|gibberish
			'type' => 'p',
			'elements' => '5',
			'words' => '20-60',
		);

		// merge arrays
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge($default_args, $args);

		// combine type and element
		if ($args['elements'] != '') {
			$args['type'] = $args['type'] . '-' . $args['elements'];
		}

		// create url
		$url = $args['domain'] . '/' . $args['generator'] . '/' . $args['type'] . '/' . $args['words'];
		
		// get text output
		$remote_data = file_get_contents($url);
		$text_out = json_decode($remote_data, true)['text_out'];

		return $strip_tags ? strip_tags($text_out) : $text_out;
	}

	
	/**
	 * creates a h1 element
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$args (array) arguments for text generation
	 * @param 	$strip_tags (bool) if html tags are stripped from result
	 * @return  string
	 */
	public static function h1($args = array(), $strip_tags = false) {
		$default_args = array('type' => 'h1', 'elements' => '', 'words' => '3-10' );
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge($default_args, $args);
		echo self::text($args, $strip_tags);
	}

	/**
	 * creates a h2 element
	 * see h1 function
	 */
	public static function h2($args = array(), $strip_tags = false) {
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge(array('type' => 'h2' ), $args);
		self::h1( $args, $strip_tags );
	}
	
	/**
	 * creates a h3 element
	 * see h1 function
	 */
	public static function h3($args = array(), $strip_tags = false) {
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge(array('type' => 'h3' ), $args);
		self::h1( $args, $strip_tags );
	}

	/**
	 * creates a h4 element
	 * see h1 function
	 */
	public static function h4($args = array(), $strip_tags = false) {
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge(array('type' => 'h4' ), $args);
		self::h1( $args, $strip_tags );
	}
	
	/**
	 * creates an ordered list element
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$args (array) arguments for text generation
	 * @param 	$strip_tags (bool) if html tags are stripped from result
	 * @return  string
	 */
	public static function ol($args = array(), $strip_tags = false) {
		$default_args = array('type' => 'ol', 'elements' => '5', 'words' => '3-10' );
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge($default_args, $args);
		echo self::text($args, $strip_tags);
	}

	/**
	 * creates an unordered list element
	 * see ol function
	 */
	public static function ul($args = array(), $strip_tags = false) {
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge(array('type' => 'ul' ), $args);
		self::ol( $args, $strip_tags );
	}
	
	/**
	 * creates a paragraph element
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$args (array) arguments for text generation
	 * @param 	$strip_tags (bool) if html tags are stripped from result
	 * @return  string
	 */
	public static function p($args = array(), $strip_tags = false) {
		$default_args = array('type' => 'p', 'elements' => '3', 'words' => '30-100' );
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge($default_args, $args);
		echo self::text($args, $strip_tags);
	}

	/**
	 * creates a blockquote element
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$args (array) arguments for text generation
	 * @param 	$strip_tags (bool) if html tags are stripped from result
	 * @return  string
	 */
	public static function blockquote($args = array(), $strip_tags = false) {
		$default_args = array('type' => 'p', 'elements' => '2', 'words' => '20-40' );
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge($default_args, $args);
		$text_out = '<blockquote>'.self::text($args, $strip_tags).'</blockquote>';
		echo $text_out;	
	}

	/**
	 * creates a table element
	 *
	 * @since   1.0.0
	 * @date    17/04/06
	 * @param 	$dimensions (string) the table dimensions in x y: 4x5
	 * @param 	$header (string) 'top' or 'left' table header
	 * @param 	$args (array) arguments for text generation
	 * @param 	$strip_tags (bool) if html tags are stripped from result
	 * @return  string
	 */
	public static function table($dimensions = '4x5', $header = 'top', $args = array(), $strip_tags = true) {
		// define dimensions
		list($width, $height) = explode('x', $dimensions);
		// define text
		$th_args = array('type' => 'h1', 'elements' => '', 'words' => '3-10' );
		$th_text = self::text($th_args, $strip_tags);

		$td_args = array('type' => 'p', 'elements' => '2', 'words' => '20-40' );
		if ($args == null || $args == false) { $args = array();	}
		$args = array_merge($td_args, $args);
		$td_text = self::text($td_args, $strip_tags);

		$output = '<table>';
		$output .= '<caption>table caption</caption>';

		// table header on top
		if ($header == 'top') {
			$output .= '<thead>';
			for ($td=1; $td <= $width; $td++) { 
				$output .= '<th scope="col">'.$th_text.'</th>';
			}
			$output .= '</thead>';
		}

		for ($tr=1; $tr < $height; $tr++) {
			$output .= '<tr>';
			for ($td=1; $td <= $width; $td++) { 
				if ($header == 'left' && $td == 1) { // header on left
					$output .= '<th scope="row">'.$th_text.'</th>';
				} else { // no header at all
					$output .= '<td data-row="'.$tr.'" data-col="'.$td.'">'.$td_text.'</td>';
				}
			}
			$output .= '</tr>';
		}

		$output .= '</table>';

		echo $output;
	}






	/**
	 * creates input elements
	 *
	 * @since   1.1.0
	 * @date    17/05/03
	 * @param 	$echo (bool) if elements are echoed or string is returned
	 * @return  string
	 */
	public static function inputs($echo = true) {
		$output = '<label for="text">label for text input</label>
			<input type="text" id="text" placeholder="text">
			<input type="text" id="text_with_value" placeholder="text" value="input with value">
			<label for="text_required">required input</label>
			<input type="text" id="text_required" placeholder="text required without value" required="required">
			<input type="text" id="text_required_with_value" placeholder="text required with value" required="required" value="input required with value">
			<label for="text_disabled">disabled input</label>
			<input type="text" id="text_disabled" placeholder="text disabled" disabled="disabled">
			<input type="text" id="text_disabled_with_value" placeholder="text disabled with value" value="text disabled with value" disabled="disabled">
			<hr>
			<label for="number">number</label>
			<input type="number" id="number" placeholder="number">
			<label for="email">email</label>
			<input type="email" id="email" placeholder="email">
			<label for="password">password</label>
			<input type="password" id="password" placeholder="password">
			<label for="url">url</label>
			<input type="url" id="url" placeholder="url">
			<label for="search">search</label>
			<input type="search" id="search" placeholder="search">
			<label for="date">date</label>
			<input type="date" id="date" placeholder="date">
			<label for="color">color picker</label>
			<input type="color" id="color" value="#ff7c00">
			<hr>
			<label for="textarea">textarea</label>
			<textarea rows="5" id="textarea" placeholder="textarea"></textarea>
			<hr>
			<input type="submit" value="Submit" />
			<input type="reset" value="Reset" />
			<input type="button" value="Button" />';

		$output .= '<hr>';
		$output .= '<label for="input_with_info">input with description <small class="label__info">(optional)</small><input type="text" id="input_with_info" placeholder="optional info text"></label>';
		$output .= '<label for="input_with_help">password with helptext<input type="password" aria-describedby="passwordHelpText" id="input_with_help" placeholder="optional longer helptext with aria-describedby"><p class="help-text" id="passwordHelpText">Your password must have at least 10 characters, a number, and an Emoji.</p></label>';

		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}

	/**
	 * creates select elements
	 *
	 * @since   1.1.0
	 * @date    17/05/03
	 * @param 	$echo (bool) if elements are echoed or string is returned
	 * @return  string
	 */
	public static function selects($echo = true) {
		$output = '<label for="select">select menu
						<select id="select">
							<option value="option1">Option 1</option>
							<option value="option2">Option 2</option>
							<option value="option3">Option 3</option>
							<option value="option4">Option 4</option>
						</select>
					</label>
					<label for="select_multiple">multimple select menu
						<select id="select_multiple" multiple="multiple">
							<option value="option1">Option 1</option>
							<option value="option2">Option 2</option>
							<option value="option3">Option 3</option>
							<option value="option4">Option 4</option>
						</select>
					</label>';
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}

	/**
	 * creates radio elements
	 *
	 * @since   1.1.0
	 * @date    17/05/03
	 * @param 	$echo (bool) if elements are echoed or string is returned
	 * @return  string
	 */
	public static function radios($echo = true) {
		$output = '<fieldset>
						<legend>Group of radiobuttons</legend>
						<input type="radio" name="radio" value="Radio 1" id="radio1" checked="checked"><label for="radio1">Radio 1</label>
						<input type="radio" name="radio" value="Radio 2" id="radio2"><label for="radio2">Radio 2</label>
						<input type="radio" name="radio" value="Radio 3" id="radio3"><label for="radio3">Radio 3</label>
						<input type="radio" name="radio" value="Radio 4" id="radio4" disabled="disabled"><label for="radio4">Radio 4 disabled</label>
					</fieldset>';
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}

	/**
	 * creates checkbox elements
	 *
	 * @since   1.1.0
	 * @date    17/05/03
	 * @param 	$echo (bool) if elements are echoed or string is returned
	 * @return  string
	 */
	public static function checkboxes($echo = true) {
		$output = '<fieldset>
						<legend>Checkboxes</legend>
						<input type="checkbox" id="checkbox1" checked="checked"><label for="checkbox1">Checkbox 1</label>
						<input type="checkbox" id="checkbox2"><label for="checkbox2">Checkbox 2</label>
						<input type="checkbox" id="checkbox3"><label for="checkbox3">Checkbox 3</label>
						<input type="checkbox" id="checkbox4" disabled="disabled"><label for="checkbox4">Checkbox 4 disabled</label>
					</fieldset>';
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}

	/**
	 * creates button elements
	 *
	 * @since   1.1.0
	 * @date    17/05/03
	 * @param 	$echo (bool) if elements are echoed or string is returned
	 * @return  string
	 */
	public static function button($label, $modifier_class = '', $echo = true) {
		$output = '<button type="button" class="button '.$modifier_class.'">'.$label.'</button>';
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}




	/**
	 * creates a form element - still to implement
	 *
	 * @since   1.1.0
	 * @date    17/05/03
	 * @param 	$args (array) arguments for element creation
	 * @return  string
	 */
	public static function form($supports = array('inputs', 'selects', 'radios', 'checkboxes', 'buttons'), $echo = true) {
		if (!is_array($supports)) {
			$supports = array($supports);
		}

		$output = '<form action="#">';
		if (in_array('inputs', $supports)) {
			$output .= self::inputs(false);
			$output .= '<hr>';
		}
		if (in_array('selects', $supports)) {
			$output .= self::selects(false);
			$output .= '<hr>';
		}
		if (in_array('radios', $supports)) {
			$output .= self::radios(false);
			$output .= '<hr>';
		}
		if (in_array('checkboxes', $supports)) {
			$output .= self::checkboxes(false);
			$output .= '<hr>';
		}
		if (in_array('buttons', $supports)) {
			$output .= self::button('Default', '', false);
			$output .= self::button('Primary', 'button--primary', false);
			$output .= self::button('Secondary', 'button--secondary', false);
			$output .= self::button('Outline', 'button--outline', false);
			$output .= '<hr>';
		}
		$output .= '</form>';
		
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}
	
}

									










/**
 * placeholder wordpress functions with dummy text or image
 *
 * @author 	Neonpastell GmbH, Manuel Piepereit
 * @since   1.0.0
 * @date    17/04/06
 */
if (!function_exists('dummy_the_title')) {

	// placeholder for the_post_thumbnail()
	function dummy_the_post_thumbnail($size = 'hd', $args = array(), $echo = true) {
		// echo or return
		if ($echo) {
			echo '<img src="'.dummy::image($size, $args, false).'" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="dummy image" title="dummy image title">';
		} else {
			return $url;
		}
	}

	// placeholder for the_title()
	function dummy_the_title($before = '', $after = '', $echo = true) {
		$title = dummy::text(array('type' => 'h1', 'elements' => '', 'words' => '3-10' ), true);
		$output = $before . $title . $after;
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}

	// placeholder for the_excerpt()
	function dummy_the_excerpt() {
		echo '<p>';
		dummy::p(array('type' => 'p', 'elements' => '1', 'words' => '60-65' ), true);
		echo '[...]';
		echo '</p>';
	}

	// placeholder for the_content()
	// text from http://www.wpfill.me/
	function dummy_the_content($supports = array('intro', 'headings', 'paragraphs', 'lists', 'images', 'gallery', 'table', 'blockquote', 'address', 'form')) {
		$intro = '<p class="exposed">So here we are, testing a bunch of text and image elements available for editors from the Wordpress TinyMCE. The text below is from <a href="http://www.wpfill.de">www.wpfill.de</a> and works pretty well to style all elements during development. <br>By the way, this paragraph has an <em>.exposed</em> class to highlight certain text passages. This functionality is also made available as an MCE Plugin by <a href="http://www.neonpastell.de">Neonpastell Gmbh, Augsburg</a>.</p>';

		$headings = '<h1>Level One Heading</h1><h2>Level Two Heading</h2><h3>Level Three Heading</h3><h4>Level Four Heading</h4><h5>Level Five Heading</h5><h6>Level Six Heading</h6>';
		
		$paragraphs = '<p>This is a standard paragraph created using the WordPress TinyMCE text editor. It has a <strong>strong tag</strong>, an <em>em tag</em> and a <del>strikethrough</del> which is actually just the del element. There are a few more inline elements which are not in the WordPress admin but we should check for incase your users get busy with the copy and paste. These include <cite>citations</cite>, <abbr title="abbreviation">abbr</abbr>, bits of <code>code</code> and <var>variables</var>, <q>inline quotations</q>, <ins datetime="2011-12-08T20:19:53+00:00">inserted text</ins>, text that is <s>no longer accurate</s> or something <mark>so important</mark> you might want to mark it. We can also style subscript and superscript characters like C0<sub>2</sub>, here is our 2<sup>nd</sup> example. If they are feeling non-semantic they might even use <b>bold</b>, <i>italic</i>, <big>big</big> or <small>small</small> elements too.&nbsp;Incidentally, these HTML4.01 tags have been given new life and semantic meaning in HTML5, you may be interested in reading this <a title="HTML5 Semantics" href="http://csswizardry.com/2011/01/html5-and-text-level-semantics">article by Harry Roberts</a> which gives a nice excuse to test a link.&nbsp;&nbsp;It is also worth noting in the "kitchen sink" view you can also add <span style="text-decoration: underline;">underline</span>&nbsp;styling and set <span style="color: #ff0000;">text color</span> with pesky inline CSS.</p>
				<p style="text-align: left;">Additionally, WordPress also sets text alignment with inline styles, like this left aligned paragraph.&nbsp;Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras mattis consectetur purus sit amet fermentum.</p>
				<p style="text-align: right;">This is a right aligned paragraph.&nbsp;Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras mattis consectetur purus sit amet fermentum.</p>
				<p style="text-align: justify;">This is a justified paragraph.&nbsp;Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras mattis consectetur purus sit amet fermentum.</p>
				<p style="padding-left: 30px;">Finally, you also have the option of an indented paragraph.&nbsp;Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras mattis consectetur purus sit amet fermentum.</p>';

		$lists = '<h3>lists</h3><ol><li>Ordered list item one.</li><li>Ordered list item two.<ol><li>Ordered list item one.</li><li>Ordered list item two.</li></ol></li><li>Ordered list item three.</li><li>Ordered list item four.</li><li>By the way, Wordpress does not let you create nested lists through the visual editor.</li></ol>
				<ul><li>Unordered list item one.</li><li>Unordered list item two.</li><li>Unordered list item three.<ul><li>Unordered list item one.</li><li>Unordered list item two.</li></ul></li><li>Unordered list item four.</li><li>By the way, Wordpress does not let you create nested lists through the visual editor.</li></ul>';
		
		$images = '<h3>images</h3><p>OK, so images can get quite complicated as we have a few variables to work with! For example the image below has had a caption entered in the WordPress image upload dialog box, this creates a [caption] shortcode which then in turn wraps the whole thing in a <code>div</code> with inline styling! Maybe one day they\'ll be able to use the <code>figure</code> and <code>figcaption</code> elements for all this. Additionally, images can be wrapped in links which, if you\'re using anything other than <code>color</code> or <code>text-decoration</code> to style your links can be problematic.</p>
				<div id="attachment_28" class="wp-caption alignnone" style="width: 510px"><a href="#link"><img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_large.png" alt="Your Alt Tag" title="bmxisbest" width="500" height="300" class="size-large wp-image-28"></a><p class="wp-caption-text">This is the optional caption.</p></div>
				<p>The next issue we face is image alignment, users get the option of <em>None</em>, <em>Left</em>, <em>Right</em> &amp; <em>Center</em>. On top of this, they also get the options of <em>Thumbnail</em>, <em>Medium</em>, <em>Large</em> &amp; <em>Fullsize</em>. You\'ll probably want to add floats to style the image position so important to remember to clear these to stop images popping below the bottom of your articles.</p>
				<img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_medium.png" alt="Your Alt Title" title="Your Title" width="300" height="200" class="alignright size-medium wp-image-28">
				<img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" alt="Your Alt Title" title="Your Title" width="150" height="150" class="alignleft size-thumbnail wp-image-28">
				<img class="aligncenter size-medium wp-image-28" title="Your Title" src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_medium.png" alt="Your Alt Title" width="300" height="200">
				<img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_full.png" alt="Your Alt Title" title="Your Title" width="840" height="300" class="alignnone size-full wp-image-28">
				<p>Additionally, to add further confusion, images can be wrapped inside paragraph content, lets test some examples here.<img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_medium.png" alt="Your Alt Title" title="Your Title" width="300" height="200" class="alignright size-medium wp-image-28">
				Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean lacinia bibendum nulla sed consectetur.<img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" alt="Your Alt Title" title="Your Title" width="150" height="150" class="alignleft size-thumbnail wp-image-28">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean lacinia bibendum nulla sed consectetur.<img src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" alt="Your Alt Title" title="Your Title" width="150" height="150" class="aligncenter size-thumbnail wp-image-28">Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Aenean lacinia bibendum nulla sed consectetur.</p>';

		$gallery = '<h3>gallery</h3>
				<p>And then... Finally, users can insert a WordPress [gallery], which is kinda ugly and comes with some CSS stuck into the page to style it (which doesn\'t actually validate, nor does the markup for the gallery). The amount of columns in the gallery is also changable by the user, but the default is three so we\'ll work with that for our example with an added fouth image to test verticle spacing.</p>
				<style type="text/css">#gallery-1{margin:auto;}#gallery-1 .gallery-item{float:left;margin-top:10px;text-align:center;width:33%;}#gallery-1 img{border:2px solid #cfcfcf;}#gallery-1 .gallery-caption{margin-left:0;}</style>
				<div id="gallery-1" class="gallery galleryid-1 gallery-columns-3 gallery-size-thumbnail">
				<dl class="gallery-item"><dt class="gallery-icon"><a href="#link" title="Your Title"><img width="150" height="150" src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" class="attachment-thumbnail" alt="Your Alt Title" title="Your Title"></a></dt></dl>
				<dl class="gallery-item"><dt class="gallery-icon"><a href="#link" title="Your Title"><img width="150" height="150" src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" class="attachment-thumbnail" alt="Your Alt Title" title="Your Title"></a></dt></dl>
				<dl class="gallery-item"><dt class="gallery-icon"><a href="#link" title="Your Title"><img width="150" height="150" src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" class="attachment-thumbnail" alt="Your Alt Title" title="Your Title"></a></dt></dl>
				<br style="clear: both">
				<dl class="gallery-item"><dt class="gallery-icon"><a href="#link" title="Your Title"><img width="150" height="150" src="http://www.wpfill.me.s3-website-us-east-1.amazonaws.com/img/img_thumb.png" class="attachment-thumbnail" alt="Your Alt Title" title="Your Title"></a></dt></dl>
				<br style="clear: both;">
				</div>';
		
		$table = '<h3>table</h3><table><caption>table caption</caption><thead><tr><th scope="col">Table Head Column One</th><th scope="col">Table Head Column Two</th><th scope="col">Table Head Column Three</th></tr></thead>
				<tfoot><tr><td>Table Footer Column One</td><td>Table Footer Column Two</td><td>Table Footer Column Three</td></tr></tfoot>
				<tbody><tr><td>Table Row Column One</td><td>Short Text</td><td>Testing a table cell with a longer amount of text to see what happens, you\'re not using tables for site layouts are you?</td></tr><tr><td>Table Row Column One</td><td>Table Row Column Two</td><td>Table Row Column Three</td></tr><tr><td>Table Row Column One</td><td>Table Row Column Two</td><td>Table Row Column Three</td></tr><tr><td>Table Row Column One</td><td>Table Row Column Two</td><td>Table Row Column Three</td></tr><tr><td>Table Row Column One</td><td>Table Row Column Two</td><td>Table Row Column Three</td></tr></tbody></table>';
		
		$blockquote = '<blockquote>Currently WordPress blockquotes are just wrapped in blockquote tags and have no clear way for the user to define a source. Maybe one day they\'ll be more semantic (and easier to style) like the version below.</blockquote>
				<blockquote cite="http://html5doctor.com/blockquote-q-cite/"><p>HTML5 comes to our rescue with the footer element, allowing us to add semantically separate information about the quote.</p><footer><cite><a href="http://html5doctor.com/blockquote-q-cite/">Oli Studholme, HTML5doctor.com</a></cite></footer></blockquote>';
		
		$address = '<p>And last, and by no means least, users can also apply the <code>Address</code> tag to text like this:</p> 
<address>123 Example Street,
Testville,
West Madeupsburg,
CSSland,
1234</address> 
<p>...so there you have it, all our text elements</p>';

		$output = '';
		if (in_array('intro', $supports)) {			$output .= $intro; }
		if (in_array('headings', $supports)) {		$output .= $headings; }
		if (in_array('paragraphs', $supports)) {	$output .= $paragraphs; }
		if (in_array('lists', $supports)) {			$output .= $lists; }
		if (in_array('images', $supports)) {		$output .= $images; }
		if (in_array('gallery', $supports)) {		$output .= $gallery; }
		if (in_array('table', $supports)) {			$output .= $table; }
		if (in_array('blockquote', $supports)) {	$output .= $blockquote; }
		if (in_array('form', $supports)) {			$output .= dummy::form(array('inputs', 'selects', 'radios', 'checkboxes', 'buttons'), false); }
		if (in_array('address', $supports)) {		$output .= $address; }
		echo $output;

	}

}