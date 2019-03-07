<?
require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");

//$request_uri = '/development/projects/modulnaya_laboratoriya_v_petropavlovske_kamchatskom/';
//$regexp = '~^/development/[^/]+/\w+~';
//if (!preg_match($regexp, $request_uri))
//   echo 'я где-то накосячил';
//else
//   echo 'Ура, заработало!';


$request_uri = '120мл';
$regexp = '~([\d\,\.]+)\s*([А-яA-z\d\-\_]*)~';
if (!preg_match($regexp, $request_uri))
    echo 'я где-то накосячил';
else
    echo 'Ура, заработало!';

?>