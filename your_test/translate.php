<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
$params = Array(
		   "max_len" => "100", // обрезает символьный код до 100 символов
		   "change_case" => "L", // буквы преобразуются к нижнему регистру
		   "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
		   "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
		   "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
		);

			
		$code = CUtil::translit("раз_два", "ru", $params);
        echo $code;
