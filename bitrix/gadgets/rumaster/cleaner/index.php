<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeModuleLangFile(__FILE__);

function gt_rm_delete_cache($path)
{
    if (strlen($path) == 0 || $path == '/')
        return false;

    $full_path = $_SERVER["DOCUMENT_ROOT"].$path;

    $f = true;
    if (is_file($full_path) || is_link($full_path))
    {
        if(@unlink($full_path))
            return true;
        return false;
    }
    elseif (is_dir($full_path))
    {
        if($handle = opendir($full_path))
        {
            while(($file = readdir($handle)) !== false)
            {
                if ($file == "." || $file == "..")
                    continue;

                if (!DeleteDirFilesEx($path."/".$file))
                    $f = false;
            }
            closedir($handle);
        }
        return $f;
    }
    return false;
}

function gt_rm_info($path) {
    $full_path = $path;
    $info = array(
        'count' => 0,
        'size' => 0
    );
    
    foreach (scandir($full_path) as $file) {
        if ($file != '.' && $file != '..') {
            $file_path = $full_path.DIRECTORY_SEPARATOR.$file;
            if (is_dir($file_path)) { 
                $tmp = gt_rm_info($file_path); 

                $info['count'] += $tmp['count']; 
                $info['size'] += $tmp['size']; 
            }
            else { 
                $info['count']++;
                $info['size'] += filesize($file_path); 
            }
        }
    }
    
    return $info;   
}

function gt_rm_delete_seo_cache(){
    $db_result = \CIBlock::GetList(
        array(), 
        array(
            'SITE_ID'=>SITE_ID, 
            'ACTIVE'=>'Y', 
        ),
        false
    );
    while($row = $db_result->Fetch())
    {
        var_dump($row);
    }
}
// if ($_POST["IPROPERTY_CLEAR_VALUES"] === "Y")
//             {
//                 $ipropValues = new \Bitrix\Iblock\InheritedProperty\IblockValues($ID);
//                 $ipropValues->clearValues();
//             }

$cache_types = array(
    'cache' => array(
        'name' => GetMessage('GT_RM_UNGOVERNABLE_CACHE'),
        'path' => '/bitrix/cache',
    ),
    'managed_cache' => array(
        'name' => GetMessage('GT_RM_MANAGED_CACHE'),
        'path' => '/bitrix/managed_cache',
    ),
    'stack_cache' => array(
        'name' => GetMessage('GT_RM_STACK_CACHE'),
        'path' => '/bitrix/stack_cache',
    ),
    'resize_cache' => array(
        'name' => GetMessage('GT_RM_RESIZE_CACHE'),
        'path' => '/upload/resize_cache',
    ),
    'seo_cache' => array(
        'name' => GetMessage('GT_RM_SEO_CACHE'),
    ),
);

if (!empty($_POST['gt_rm_cache'])) {
    if (isset($_POST['gt_rm_cache']['clear_all'])) {     
        foreach($cache_types as $cache) {
            if (isset($cache['path'])) {
                gt_rm_delete_cache($cache['path']);  
            }
        }
        gt_rm_delete_seo_cache();
    }
    if (isset($_POST['gt_rm_cache']['clear_cache'])) {     
        foreach(array('cache', 'managed_cache', 'stack_cache') as $key) {
            $cache = $cache_types[$key];
            gt_rm_delete_cache($cache['path']);  
        }
    }
    if (isset($_POST['gt_rm_cache']['clear'])) {
        $cache_key = array_keys($_POST['gt_rm_cache']['clear']);
        reset($cache_key);
        $cache_key = current($cache_key);

        if (isset($cache_types[$cache_key])) {
            $cache = $cache_types[$cache_key];
            if ($cache['path']) {
                gt_rm_delete_cache($cache['path']);  
            }
            else if ('seo_cache' === $cache_key) {
                gt_rm_delete_seo_cache();
            }
        }
    }
    header ('Location: /bitrix/admin/');
    exit;
}
    
foreach ($cache_types as $cache_key => $cache) {
    if (isset($cache['path'])) {
        $info = gt_rm_info($_SERVER['DOCUMENT_ROOT'].$cache['path']);

        $cache['dir_file_count'] = $info['count'];
        $cache['dir_size'] = round($info['size'] / 1024 / 1024, 2).' '.GetMessage('GT_RM_CACHE_SIZE_MB');
    }
    else {
        $cache['dir_file_count'] = '';
        $cache['dir_size'] = '';
    }

    $cache_types[$cache_key] = $cache;
}
unset($info);
?>

<style>
    #gt_rm_cache_gadget { background: #f5f9f9; border-top: 1px solid #d7e0e8; }
    #gt_rm_cache_gadget table { width: 100%; border-collapse: collapse; }
    #gt_rm_cache_gadget table th,
    #gt_rm_cache_gadget table td { vertical-align: top; text-align: left; padding: 10px; border-bottom: 1px solid #fff; }
    #gt_rm_cache_gadget form { padding: 10px; }
</style>

<div id="gt_rm_cache_gadget">
    <table>
        <tr>
            <th><?= GetMessage('GT_RM_CACHE_TYPE') ?></th>
            <th><?= GetMessage('GT_RM_CACHE_PATH') ?></th>
            <th><?= GetMessage('GT_RM_CACHE_DIR_FILES_COUNT') ?></th>
            <th><?= GetMessage('GT_RM_CACHE_DIR_SIZE') ?></th>
            <th></th>
        </tr>

    <? foreach ($cache_types as $cache_key => $cache): ?>
        <tr>
            <td><?= $cache['name'] ?></td>
            <td>
                <? if (!empty($cache['path'])): ?>
                    <a href="/bitrix/admin/fileman_admin.php?lang=ru&path=<?= $cache['path'] ?>">
                        <?= $cache['path'] ?>
                    </a>
                <? endif; ?>
            </td>
            <td><?= $cache['dir_file_count'] ?></td>
            <td><?= $cache['dir_size'] ?></td>
            <td>
                <form method="post" action="">
                    <input type="submit" 
                        name="gt_rm_cache[clear][<?= $cache_key ?>]" 
                        value="<?= GetMessage('GT_RM_CLEAN') ?>" 
                        class="adm-btn-save">
                </form>
            </td>
        </tr>

    <? endforeach; ?>

    </table>

    <form method="post" action="">
        <input type="submit"
            name="gt_rm_cache[clear_cache]"
            value="<?= GetMessage('GT_RM_CLEAN_CACHE') ?>"
            class="adm-btn-save">
        <input type="submit"
            name="gt_rm_cache[clear_all]"
            value="<?= GetMessage('GT_RM_CLEAN_ALL') ?>"
            class="adm-btn-save">
    </form>
</div>
