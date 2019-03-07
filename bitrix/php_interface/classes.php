<?
// Класс для построения постранички из массива данных
// Используется в:
//      1. /bitrix/templates/.default/components/makerealty/sale.personal.order.list/my_documents_list_mr/
/*class CCabinet_SortObject {

    function __cmp_ValueOf($a, $b, $name, $order) {
        if(is_set($a[$name]) && is_set($b[$name])) {
            if($order == 'ASC')
                return ($a[$name]<$b[$name])?true:false;
            elseif($order == 'DESC')
                return ($b[$name]>$a[$name])?false:true;
        }
    }

    function cmp_STATUS_ASC($a, $b) {
        return CCabinet_SortObject::__cmp_ValueOf($a, $b, "STATUS", "ASC");
    }

    function cmp_STATUS_DESC($a, $b) {
        return CCabinet_SortObject::__cmp_ValueOf($a, $b, "STATUS", "DESC");
    }

    function cmp_NAME_ASC($a, $b) {
        return CCabinet_SortObject::__cmp_ValueOf($a, $b, "OBJECT_NAME", "ASC");
    }

    function cmp_NAME_DESC($a, $b) {
        return CCabinet_SortObject::__cmp_ValueOf($a, $b, "OBJECT_NAME", "DESC");
    }

    function cmp_CITY_ASC($a, $b) {
        return CCabinet_SortObject::__cmp_ValueOf($a, $b, "CITY_NAME", "ASC");
    }

    function cmp_CITY_DESC($a, $b) {
        return CCabinet_SortObject::__cmp_ValueOf($a, $b, "CITY_NAME", "DESC");
    }

    function cmp_DATE_DESC($a, $b) {
        if ($a["DATE_INSERT"],"SHORT", "s1") == ConvertTimeStamp($b["DATE_INSERT"],"SHORT", "s1")) {
            return 0;
        }
        return (ConvertTimeStamp($a["DATE_INSERT"],"SHORT", "s1") > ConvertTimeStamp($b["DATE_INSERT"],"SHORT", "s1")) ? -1 : 1;
    }

    function cmp_DATE_DESC($a, $b) {
        if (MakeTimeStamp($a["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS") == MakeTimeStamp($b["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS")) {
            return 0;
        }
        return (MakeTimeStamp($a["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS") > MakeTimeStamp($b["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS")) ? -1 : 1;
    }

    function cmp_DATE_ASC($a, $b) {
        if (MakeTimeStamp($a["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS") == MakeTimeStamp($b["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS")) {
            return 0;
        }
        return (MakeTimeStamp($a["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS") < MakeTimeStamp($b["DATE_INSERT"], "DD.MM.YYYY HH:MI:SS")) ? -1 : 1;
    }
}*/
?>