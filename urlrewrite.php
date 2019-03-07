<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/catalog/manufacturers/section/([a-z0-9_-]+)/([a-z0-9_-]+)/[^/]*$#',
    'RULE' => 'BRAND_CODE=$1&SECTION_CODE=$2',
    'ID' => '',
    'PATH' => '/catalog/manufacturers/section/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/brands/([0-9]+)/([0-9]+)/#',
    'RULE' => 'BREND_ID=$1&ELEMENT_ID=$2',
    'PATH' => '/brands/brand_detail.php',
    'SORT' => '100',
  ),
  2 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => '100',
  ),
  3 => 
  array (
    'CONDITION' => '#^/catalog/manufacturers/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/catalog/manufacturers/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/development/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/development/projects/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/catalog/balances/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/balances/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/brands/([0-9]+)/#',
    'RULE' => 'BREND_ID=$1',
    'PATH' => '/brands/brand.php',
    'SORT' => '100',
  ),
  7 => 
  array (
    'CONDITION' => '#^/catalog.new/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog.new/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/feed-back/#',
    'RULE' => '',
    'ID' => 'bitrix:iblock.element.add.form',
    'PATH' => '/feed-back/index.php',
    'SORT' => '100',
  ),
  9 => 
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/articles/index.php',
    'SORT' => '100',
  ),
  13 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/tasks/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/tasks/index.php',
    'SORT' => '100',
  ),
  12 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
