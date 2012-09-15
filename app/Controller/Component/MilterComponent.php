<?php
class MilterComponent extends Object  {
    
	var $name = 'Milter';
	
	function initialize(){
	}
	/**
	 * Replaces all characters except the alphanumeric ones by the empty string
	 * This filter accepts only alphanumeric filters. These
	 * are a-z, A-Z and 0-9. Spaces are not allowed, too.
	 * @param mixed $mInput
	 * @return string no more special characters
	 */

	public function alphanumericCharsFilter($mInput) {

		return preg_replace('~[^a-zA-Z0-9]~', '', $mInput);
	}
	
	/**
	 * The input is casted to boolean. Additionally it is checked
	 * to be the string 'false' that is considered as the boolean
	 * false value, too.
	 *
	 * @param mixed $mInput the input
	 * @return boolean
	 */

	public function booleanFilter($mInput) {

		// additionally to PHP's boolean typecasts, consider
		// the string 'false' as the boolean false value
		if (strtolower(trim($mInput)) === 'false') {

			return false;
		}

		return (boolean) $mInput;
	}
	
	/**
	 * Performs the filtering
	 * This filter replaces HTML and XML entities in the input stream with
	 * their original characters. XML entities can be denoted as decimal
	 * or hexadecimal way.
	 * @param mixed $mInput the input with entities
	 * @return string all known entities back-substituted
	 */

	public function entityDecodeFilter($mInput) {

		// decode XML entities
		$mInput = preg_replace('~&#x([0-9a-f]{1,7});~ei', 'chr(hexdec("\\1"))', $mInput);
		$mInput = preg_replace('~&#([0-9]{1,7});~e', 'chr(\\1)', $mInput);

		// decode HTML entities
		$arrTable = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
		$arrTable = array_flip($arrTable);
		$mInput = strtr($mInput, $arrTable);

		return $mInput;
	}
	
	/**
	 * This filter converts incoming values to float values. Both
	 * characters , and . are considered as a comma (german notation).
	 * Transform the input value into a float value. Any occurence of
	 * a comma (,) will be transformed to a point (.) By doing this, the
	 * german float number notation with comma is supported implicitly.
	 *
	 * @param mixed $mInput the raw float value
	 * @return float a real float
	 */

	public function floatFilter($mInput) {

		// replace german commas by points
		$mInput = str_replace(',', '.', $mInput);

		return floatval($mInput);
	}
    
	/**
	 * Converts incoming data into integer values.
	 * The filter method applies only the intval() function.
	 *
	 * @param mixed $mInput the raw input
	 * @return int the "found" integer
	 */

	public function integerFilter($mInput) {

		return intval($mInput);
	}
	
	/**
	 * This filter removes all well-formed HTML from the input.
	 * The filter method is just a wrapper for the strip_tags()
	 * function of PHP.
	 *
	 * @param mixed $mInput the input
	 * @return string the input without the tags
	 */

	public function noHTMLFilter($mInput) {

		// remove any disallowed characters and attribute injection
		// taken from the book php|architect's Guide to PHP Security page 62
		$mInput = preg_replace('~<([A-Z]\w*)(?:\s* (?:\w+) \s* = \s* (?(?=["\']) (["\'])(?:.*?\2)+ | (?:[^\s>]*) ) )* \s* (\s/)? >~ix', '<\1\5>', $mInput);

		// remove all well-formed tags
		$mInput = strip_tags($mInput);

		return $mInput;
	}
	
	/**
	 * This filter tries to remove all scripting things from the input
	 * data. It supports several well-formed scripting things, as well
	 * as scripting abilities that are possible due to browser bugs.
	 *
	 * This filter can be used as a sanitizing input filter to prevent XSS
	 * attacks, but preserve the (X)HTML.
	
	 * The filter method applies all implemented un-scripting
	 * patterns
	 *
	 * @param mixed $sData all input data
	 * @return string the input without the scripting things
	 */

	public function noScriptFilter($sData) {

		$arrPatterns = array();

		// decode all HTML and XML entities
		$sData = $this->entityDecodeFilter($sData);


		// remove script areas
		$arrPatterns[] = '~<\s*script[^>]*>(?:.*<\s*/\s*script\s*>)?~is';


		// remove script areas like this:
		// <script src="http://badhost.com/xss.js" </script
		// because of Firefox bug #226495 (@Bugzilla)
		$arrPatterns[] = '~<\s*script[^>]*(?:.*<\s*/\s*script\s*)?~is';


		// remove script links
		// encoded script links will be removed too because of
		// the global decryption at the beginning
		$arrPatterns[] = '~j\s*a\s*v\s*a\s*s\s*c\s*r\s*i\s*p\s*t\s*:|' .		// javascript:
						 'j\s*s\s*c\s*r\s*i\s*p\s*t\s*:|' .						// jscript:
						 'l\s*i\s*v\s*e\s*s\s*c\s*r\s*i\s*p\s*t\s*:|' .			// livescript:
						 'm\s*o\s*c\s*h\s*a\s*:|' .								// mocha:
						 'd\s*a\s*t\s*a\s*:|' .									// data:
						 'v\s*b\s*s\s*c\s*r\s*i\s*p\s*t\s*:~i';					// vbscript


		// remove event attributes (well-formed)
		// <a ... onclick="...">
		while (preg_match('~<[^>]*(on[a-z]+\s*=\s*(?:(?:"[^"]*")|(?:\'[^\']*\')))[^>]*>?~is', $sData, $arrRes)) {

			$sData = str_replace($arrRes[1], '', $sData);
		}


		// remove event attributes (not well-formed; destructive)
		// e.g. <a href="" onclick=alert('xss');
		$arrPatterns[] = '~<[^>]*on[a-z]+[^a-z0-9=]*=\s*[^"\'\s][^>]*>?~is';


		// remove scripts in styles areas (Mozilla: -moz-binding)
		// because of Firefox Bug #324253 (@Bugzilla)
		while (preg_match('~<\s*style[^>]*>?.*{.*(-moz-binding\s*:[^;]*;?)~is', $sData, $arrRes)) {

			$sData = str_replace($arrRes[1], '', $sData);
		}


		// remove scripts in styles areas (Internet Explorer: expression)
		// top: expression(alert('xss'));
		while (preg_match('~<\s*style[^>]*>?.*{.*(expression\s*\([^\)]*\)*);?~is', $sData, $arrRes)) {

			$sData = str_replace($arrRes[1], '', $sData);
		}


		// remove scripts in styles attributes (Mozilla: -moz-binding)
		// because of Firefox Bug #324253 (@Bugzilla)
		while (preg_match('~<[^>]*style\s*=.*(-moz-binding\s*:[^;]*;?)~is', $sData, $arrRes)) {

			$sData = str_replace($arrRes[1], '', $sData);
		}


		// remove scripts in styles attributes (Internet Explorer: expression)
		// <p style="top:expression(alert('xss'));">XSS Test</p>
		while (preg_match('~<[^>]*style\s*=.*(expression\s*\([^\)]*\)*);?~is', $sData, $arrRes)) {

			$sData = str_replace($arrRes[1], '', $sData);
		}


		// perform replacements
		$sData = preg_replace($arrPatterns, '', $sData);

		return $sData;
	}
	
	/**
	 * This filter removes all special character from the input.
	 * As normal characters the following are considered:
	 *
	 *   - a-z
	 *   - A-Z
	 *   - 0-9
	 *   - ,
	 *   - .
	 *   - :
	 *   - ;
	 *   - !
	 *   - -
	 *   - _
	 *
	 * This filter could be used as a sanitizer for simple texts.
	 *
	 * NOTE: German umlauts are filtered out.
	 * Replaces all special characters by the empty string
	 *
	 * @param mixed $mInput
	 * @return string no more special characters
	 */
	public function noSpecialCharsFilter($mInput) {
		return preg_replace('~[^a-zA-Z0-9,\.;:!\-_ ]~', '', $mInput);
	}
	
	/**
	 * This filter is an adapter class to use PHP's filter facilities
	 * with Tekuna. Example:
	 *
	 * PHP:
	 *      filter_var($sInput, FILTER_SANITIZE_STRIPPED);
	 * Applies the filter with the given input with the filter_var() function.
	 *
	 * @param mixed $mInput
	 * @return mixed the output
	 */

	public function phpInternalFilter($mInput, $iFilterType, $mOptions = NULL) {

		if ($mOptions === NULL) {

			return filter_var($mInput, $iFilterType);
		}
		else {

			return filter_var($mInput, $iFilterType, $mOptions);
		}
	}
	
	/**
	 * This filter removes all control characters, except new lines and tabs
	 * Filter out all control characters
	 *
	 * @param mixed $mInput
	 * @return string
	 */

	public function printableCharsFilter($mInput) {

		// replace all control characters, except new lines (#10) and tabs (#9)
		return preg_replace('~[\x00-\x08\x0B-\x1F]~', '', $mInput);
	}
	
	/**
	 * This filter can be used to sanitize inputs that will be part
	 * of SQL statements. It is a combination of addslashes and some
	 * control character replacements.
	 * Apply the filter
	 *
	 * @param mixed $mInput
	 * @return string
	 */
	public function sqlFilter($mInput) {

		// standard escapes
		$mInput = addslashes($mInput);

		// special escapes
		$mInput = str_replace("\n", "\\\n", $mInput);
		$mInput = str_replace("\r", "\\\r", $mInput);
		$mInput = str_replace("\t", "\\\t", $mInput);
		$mInput = str_replace("\x1a", "\\\x1a", $mInput);

		return $mInput;
	}
	
	/**
	 * Converts all file endings in the given string to the Unix style (LF only).
	 * The Windows style (CRLF) and the old Mac OS style (CR) are handled.
	 * The filter method converts the line endings
	 */

	public function unixLineDelimitersFilter($mInput) {

		// change the line delimiters
		$mInput = str_replace("\r\n", "\n", $mInput);
		$mInput = str_replace("\r", "\n", $mInput);

		// return the modified file
		return $mInput;
	}
}
?>
