<?php
if( ! function_exists('content_get_first_img')){

	function content_get_first_img($html = '') {
		/**
		$pattern = '/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'\s>]*)/i';
		
		preg_match_all($pattern, $html, $matches);
		
		return $matches;
		*/
		if (stripos($html, '<img') !== false) {
			$imgsrc_regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
			preg_match($imgsrc_regex, $html, $matches);
			unset($imgsrc_regex);
			unset($html);
			if (is_array($matches) && !empty($matches)) {
				return $matches[2];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

if( ! function_exists('content_get_readmore')){

	function content_get_readmore($html = '', $nwords=30) {
		
		$html = strip_tags ($html);
		
		if($nwords) $html = implode(' ', array_slice(explode(' ', $html), 0, $nwords));
		
		return $html;
	}
}