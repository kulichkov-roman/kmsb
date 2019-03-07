<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>

<?

//$request_uri = '120/1см';
//$regexp = '~([\d\,\.]+)\s*([А-яA-z\d\-\_]*)~';
//if (!preg_match($regexp, $request_uri))
//    echo 'я где-то накосячил';
//else
//    echo 'Ура, заработало!';

echo "Другие символы\n";
$images_oops = array('120 л','20 л', '220 л');
print_r($images_oops);
natsort($images_oops);
print_r($images_oops);
echo "<br>";
echo "Другие символы\n";
$images_oops = array('0,00...90%','0...85%', '0,0...100%');
print_r($images_oops);
natsort($images_oops);
print_r($images_oops);
?>