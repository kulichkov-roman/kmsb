<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//$word = mb_strtoupper($word, 'UTF-8');
//$text = mb_strtoupper($text, 'UTF-8');//

function mb_substr_replace($output, $replace, $posOpen, $posClose) {
	return mb_substr($output, 0, $posOpen).$replace.mb_substr($output, $posClose+1);
}

$text = 'абсдУееееццццц';
$word = 'уееее';

$textLower = ToLower($text);
$wordLower = ToLower($word);

$beginPos = Bxstrrpos($textLower, $wordLower);

$testLength = mb_strlen($wordLower);
$wordFormText = mb_substr($text, $beginPos, $testLength);

$strReplace = '<b style="color:#34a2f8; background:#fed330;">'.$wordFormText.'</b>';

$text = mb_substr_replace($text, $strReplace, $beginPos, $testLength);

echo $text;

//var_dump(Bxstrrpos($text, $word));

//echo $text;
//echo '---------------';
//
//$pattern = "/((?:^|>)[^<]*)(".$word.")/is";
//$replace = '$1<b style="color:#34a2f8; background:#fed330;">$2</b>';
//$text = preg_replace($pattern, $replace, $text);
//
//$haystack = 'ababcd';
//$needle   = 'aB';
//
//$pos      = strripos($haystack, $needle);
//
//if ($pos === false) {
//	echo "К сожалению, ($needle) не найдена в ($haystack)";
//} else {
//	echo "Поздравляем!\n";
//	echo "Последнее вхождение ($needle) найдено в ($haystack) в позиции ($pos)";
//}


?>