<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?//echo ConvertDateTime("2015-02-19 00:00:00", "MM.DD.YY", "ru");?>
<?//echo FormatDate('<\s\p\a\n>j F Y г.</\s\p\a\n> H:i', '2015-02-19 00:00:00')?>

<?
//$datetime = "2015-02-19 00:00:00";
//$format = "YYYY.MM.DD HH:MI:SS";
//echo "Исходное время: ".$datetime."<br>";
//echo "Формат: ".$format."<hr>";
//if ($arr = ParseDateTime($datetime, $format))
//{
//	echo "День:    ".$arr["DD"]."<br>";    // День: 21
//	echo "Месяц:   ".$arr["MM"]."<br>";    // Месяц: 1
//	echo "Год:     ".$arr["YYYY"]."<br>";  // Год: 2004
//	echo "Часы:    ".$arr["HH"]."<br>";    // Часы: 23
//	echo "Минуты:  ".$arr["MI"]."<br>";    // Минуты: 44
//	echo "Секунды: ".$arr["SS"]."<br>";    // Секунды: 15
//}
//else echo "Ошибка!";
//
//echo date('d.m.Y H:i:s', strtotime($datetime));
?>

<?
$date = "2015-02-19T00:00:00";
echo "Исходная дата: ".$date."<br>";

// получим Unix timestamp из заданной даты
$stmp1 = MakeTimeStamp($date, "DD.MM.YYYY HH:MI:SS");

// добавим к полученному Unix timestamp
// 1 день, 1 месяц, 1 год, 1 час, 1 минуту, 1 секунду
$arrAdd = array(
	"DD"	=> 1,
	"MM"	=> 1,
	"YYYY"	=> 0,
	"HH"	=> 0,
	"MI"	=> 0,
	"SS"	=> 0,
);
$stmp2 = AddToTimeStamp($arrAdd, $stmp1);

// выведем полученную дату
echo "Результат: ".date("d.m.Y", $stmp2); // 07.03.2006 12:33:01

$date1 = date("d.m.Y", $stmp1);
$date2 = date("d.m.Y", $stmp2);

$result = $DB->CompareDates($date1, $date2);
echo '<br>';
if ($result==1) echo $date1." > ".$date2;
elseif ($result==-1) echo $date1." < ".$date2;
elseif ($result==0) echo $date1." = ".$date2;
?>