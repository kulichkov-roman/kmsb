<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="catalog-menu">
    <ul class="catalog-type__list">
        <li class="catalog-type__item"><span class="catalog-type__link catalog-type__link_state_active" title="Каталог"><span class="link-text">По всем товарам</span></span></li>
        <li class="catalog-type__item"><a href="/catalog/manufacturers/8243785/" class="catalog-type__link" title="По производителям"><span class="link-text">По производителям</span></a></li>
    </ul>
    <div class="catalog-menu-tools">
        <div class="menu-toggler">
            <ul class="menu-toggle__list">
                <li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="show-available" title="&lt;span class=&quot;link-text&quot;&gt;Показать только с остатками&lt;/span&gt;"><span class="link-text">Показать только с остатками</span></a></li>
                <li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="show-all" title="&lt;span class=&quot;link-text&quot;&gt;Показать все&lt;/span&gt;"><span class="link-text">Показать все</span></a></li>
            </ul>
        </div>
        <div class="menu-toggler">
            <ul class="menu-toggle__list">
                <li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="open-all" title="&lt;span class=&quot;link-text&quot;&gt;Развернуть все&lt;/span&gt;"><span class="link-text">Развернуть все</span></a></li>
                <li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="close-all" title="&lt;span class=&quot;link-text&quot;&gt;Свернуть все&lt;/span&gt;"><span class="link-text">Свернуть все</span></a></li>
            </ul>
        </div>
    </div>
    <ul class="catalog-menu__list">
        <li class="catalog-menu__item ">
            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/mebel-laboratornaya-883/"><span class="link-text">Мебель лабораторная</span> <span class="catalog-menu__count">(135)</span></a>
            <ul class="catalog-menu__list catalog-menu__list-level-1">
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/7859538/7859543/">Анализаторы конвейерные <span class="catalog-menu__count">(18)</span></a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/mebel-laboratornaya--lab-pro-2012-885/"> <span class="link-text">Мебель лабораторная ЛАБ-PRO 2012 <span class="catalog-menu__count">(34)</span></span></a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/aksessuary-i-prinadlezhnosti-k-vytyazhnym-shkafam-886/"> <span class="link-text">Аксессуары и принадлежности к вытяжным шкафам</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/vspomogatelnye-prisposobleniya-887/">Вспомогательные приспособления</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/koroba-bokovye-888/">Короба боковые</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/kyuvety-polipropilenovye-889/">Кюветы полипропиленовые</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/patrubki-dlya-podvoda-gazov-vody-890/">Патрубки для подвода газов, воды</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/polki-zadnie-891/">Полки задние</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/rakoviny-slivnye-892/">Раковины сливные</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/svetilniki-vzryvobezopasnye-893/">Светильники взрывобезопасные</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/steklodveri-razdvizhnye-894/">Стеклодвери раздвижные</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/tumby-nizhnie-vstraivaemye-895/">Тумбы нижние встраиваемые</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/ustroystva-upravleniya-ekranom-vytyazhnogo-shkafa-896/">Устройства управления экраном вытяжного шкафа</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/aksessuary-i-prinadlezhnosti-k-laboratornym-stolam-897/"> <span class="link-text">Аксессуары и принадлежности к лабораторным столам</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/zaglushki-tortsevye-k-ostrovnomu-stolu-898/">Заглушки торцевые к островному столу</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/zonty-vytyazhnye-899/">Зонты вытяжные</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/koroba-bokovye-900/">Короба боковые</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/krany-dlya-podvoda-gazov-vody-901/">Краны для подвода газов, воды</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/svetilniki-v-stellazh-902/">Светильники в стеллаж</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/stellazhi-tehnologicheskie-stoyki-i-vstroennye-zasteklennye-polki-k-nim-903/">Стеллажи, технологические стойки и встроенные застекленные полки к ним</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/tumby-navesnye-904/">Тумбы навесные</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/tumby-podkatnye-905/">Тумбы подкатные</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/elektroprisposobleniya-906/">Электроприспособления</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/kompyuternye-kompleksy-907/">Компьютерные комплексы</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-vesov-908/">Столы для весов</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-kalorimetrov-909/">Столы для калориметров</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-personala-910/">Столы для персонала</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-titrovaniya-911/">Столы для титрования</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-hromatografov-spektrometrov-912/">Столы для хроматографов, спектрометров</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-laboratornye-913/">Столы лабораторные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-na-opornyh-tumbah-914/">Столы на опорных тумбах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-ostrovnye-915/">Столы островные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-peredvizhnye-916/">Столы передвижные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-pristennye-917/">Столы пристенные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-uglovye-918/">Столы угловые</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-elektrifitsirovannye-919/">Столы электрифицированные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-moyki-920/">Столы-мойки</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-vytyazhnye-obshchego-naznacheniya-921/">Шкафы вытяжные общего назначения</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-vytyazhnye-spetsializirovannye-922/">Шкафы вытяжные специализированные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-laboratornye-navesnye-923/">Шкафы лабораторные навесные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-laboratornye-dlya-hraneniya-kislot-924/">Шкафы лабораторные для хранения кислот</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-laboratornye-iz-melamina-925/">Шкафы лабораторные из меламина</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-laboratornye-iz-metalla-926/">Шкафы лабораторные из металла</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-metallicheskie-modulnye-927/">Шкафы металлические модульные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-tortsevye-1151/">Столы торцевые</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/mebel-laboratornaya--lab-928/"> <span class="link-text">Мебель лабораторная ЛАБ (58)</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stellazhi-navesnye-930/">Стеллажи навесные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-vesov-931/">Столы для весов</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-kompyuterov-932/">Столы для компьютеров</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-mikroskopirovaniya-933/">Столы для микроскопирования</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-dlya-titrovaniya-934/">Столы для титрования</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-laboratornye-935/">Столы лабораторные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-ostrovnye-936/">Столы островные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-peredvizhnye-937/">Столы передвижные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-pismennye-938/">Столы письменные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-pristennye-939/">Столы пристенные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-elektrifitsirovannye-940/">Столы электрифицированные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/stoly-moyki-941/">Столы-мойки</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/tumby-podkatnye-942/">Тумбы подкатные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/tumby-so-stoleshnitsey-943/">Тумбы со столешницей</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-vytyazhnye-944/">Шкафы вытяжные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-laboratornye-945/">Шкафы лабораторные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shkafy-navesnye-946/">Шкафы навесные</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="catalog-menu__item">
            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/oborudovanie-analiticheskoe-1006/"> <span class="link-text">Оборудование аналитическое</span> <span class="catalog-menu__count">(378)</span></a>
            <ul class="catalog-menu__list catalog-menu__list-level-1">
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/analizatory-elementnogo-sostava-belarus-1342/">Анализаторы элементного состава (Беларусь)</a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/analizatory-zhidkosti-flyuorimetricheskie-1007/"> <span class="link-text">Анализаторы жидкости флюориметрические</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-vozduze-rz-i-atmosfere-np-1343/">Наборы для флюориметрического анализа в воздузе РЗ и атмосфере НП</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-drugih-obektah-1344/">Наборы для флюориметрического анализа в других объектах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-pitevyh-vodah-1345/">Наборы для флюориметрического анализа в питьевых водах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-pishchevyh-produktah-1346/">Наборы для флюориметрического анализа в пищевых продуктах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-pochvah-1347/">Наборы для флюориметрического анализа в почвах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-prirodnyh-pitevyh-stochnyh-vodah-1348/">Наборы для флюориметрического анализа в природных, питьевых, сточных водах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-flyuorimetricheskogo-analiza-v-promyshlennyh-vybrosah-1349/">Наборы для флюориметрического анализа в промышленных выбросах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-fotometricheskogo-analiza-v-prirodnyh-pitevyh-stochnyh-vodah-1350/">Наборы для фотометрического анализа в природных, питьевых, сточных водах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/analizatory-zhidkosti-flyuorat-1008/">Анализаторы жидкости Флюорат</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-opredeleniya-hpk-bihromatnaya-okislyaemost-1009/">Наборы для определения ХПК (бихроматная окисляемость)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/rashodnye-materialy-i-komplektuyushchie-1010/">Расходные материалы и комплектующие</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/analizatory-nefteproduktov-v-vodnyh-sredah-1012/">Анализаторы нефтепродуктов в водных средах</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/analizatory-rtuti-1013/">Анализаторы ртути</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/bloki-ochistki-vozduha-azota-1014/">Блоки очистки воздуха, азота</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/generatory-azota-1015/">Генераторы азота</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/generatory-chistogo-vodoroda-1016/">Генераторы чистого водорода</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/generatory-chistogo-vozduha-1017/">Генераторы чистого воздуха</a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/sistemy-kapillyarnogo-elektroforeza-kapel-1018/"> <span class="link-text">Системы капиллярного электрофореза Капель</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-analizov-v-lekarstvennyh-preparatah-1351/">Наборы для анализов в лекарственных препаратах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-analizov-v-napitkah-pishchevyh-produktah-i-bad-1352/">Наборы для анализов в напитках, пищевых продуктах и БАД</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-analizov-v-pochvah-1353/">Наборы для анализов в почвах</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-analizov-v-probah-pitevoy-prirodnoy-i-stochnoy-vody-1354/">Наборы для анализов в пробах питьевой, природной и сточной воды</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nabory-dlya-analizov-v-kormah-i-syre-1019/">Наборы для анализов в кормах и сырье</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="catalog-menu__item ">
            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/oborudovanie-dlya-izmereniya-fizicheskih-faktorov-1020/"> <span class="link-text">Оборудование для измерения физических факторов</span> <span class="catalog-menu__count">(107)</span></a>
            <ul class="catalog-menu__list catalog-menu__list-level-1">
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/reyki-snegomernye-1355/">Рейки снегомерные</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/schetchiki-chastits-1356/">Счетчики частиц</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/trubki-pnevmometricheskie-pito-niiogaz-1357/">Трубки пневмометрические ПИТО, НИИОГАЗ</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/anemometry-1021/">Анемометры</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/anemorumbometry-1022/">Анеморумбометры</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/barometry-1023/">Барометры</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/gigrometry-psihrometry-1024/">Гигрометры, психрометры</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/izmeriteli-vlazhnosti-i-temperatury-1031/">Измерители влажности и температуры</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/izmeriteli-kontsentratsii-pyli-1032/">Измерители концентрации пыли</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/manometry-differentsialnye-1033/">Манометры дифференциальные</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/meteomachty-1034/">Метеомачты</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/meteostantsii-1035/">Метеостанции</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/pribory-dlya-izmereniya-fotometricheskih-parametrov-1036/">Приборы для измерения фотометрических параметров</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/pribory-kombinirovannye-dlya-izmereniya-fotometricheskih-parametrov-vlazhnosti-skorosti-vetra-1037/">Приборы комбинированные для измерения фотометрических параметров, влажности, скорости ветра</a>
                </li>
            </ul>
        </li>
        <li class="catalog-menu__item ">
            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/oborudovanie-dlya-probopodgotovki-1040/"> <span class="link-text">Оборудование для пробоподготовки</span> <span class="catalog-menu__count">(20)</span></a>
            <ul class="catalog-menu__list catalog-menu__list-level-1">
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/pribory-vakuumnogo-filtrovaniya-1363/"> <span class="link-text">Приборы вакуумного фильтрования</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pribory-vakuumnogo-i-napornogo-filtrovaniya-dlya-sanitarno-virusologicheskogo-analiza-1364/">Приборы вакуумного и напорного фильтрования для санитарно-вирусологического анализа</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pribory-vakuumnogo-i-napornogo-filtrovaniya-dlya-sanitarno-parazitologicheskogo-analiza-1365/">Приборы вакуумного и напорного фильтрования для санитарно-паразитологического анализа</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pribory-vakuumnogo-filtrovaniya-dlya-opredeleniya-vzveshennyh-veshchestv-1366/">Приборы вакуумного фильтрования для определения взвешенных веществ</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pribory-vakuumnogo-filtrovaniya-dlya-opredeleniya-mutnosti-i-tsvetnosti-vody-1367/">Приборы вакуумного фильтрования для определения мутности и цветности воды</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pribory-vakuumnogo-filtrovaniya-dlya-opredeleniya-chistoty-nefteproduktov-topliv-i-masel-1368/">Приборы вакуумного фильтрования для определения чистоты нефтепродуктов, топлив и масел</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pribory-vakuumnogo-filtrovaniya-dlya-sanitarno-mikrobiologicheskogo-analiza-1369/">Приборы вакуумного фильтрования для санитарно-микробиологического анализа</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/probootborniki-dlya-vodnyh-sred-1370/">Пробоотборники для водных сред</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/smesiteli-1402/">Смесители</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/probootborniki-dlya-nefteproduktov-1371/">Пробоотборники для нефтепродуктов</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/pressy-laboratornye-1362/">Прессы лабораторные</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/agregaty-drobilno-sokratitelnye-dsa-1041/">Агрегаты дробильно-сократительные ДСА</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/agregaty-sokratitelnye-1042/">Агрегаты сократительные</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/aspiratory-1043/">Аспираторы</a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vanny-ultrazvukovye-1044/"> <span class="link-text">Ванны ультразвуковые</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/vanny-ultrazvukovye-daihan-yuzhnaya-koreya-1045/">Ванны ультразвуковые Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/vanny-ultrazvukovye-sapfir-rossiya-1046/">Ванны ультразвуковые Сапфир (Россия)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/deliteli-prob-1047/">Делители проб</a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/drobilki-1048/"> <span class="link-text">Дробилки</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/drobilki-valkovye-dvg-1049/">Дробилки валковые ДВГ</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/drobilki-molotkovye-md-1050/">Дробилки молотковые МД</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/drobilki-shchekovye-shchd-1051/">Дробилки щековые ЩД</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/istirateli-1052/"> <span class="link-text">Истиратели</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/istirateli-chashechnye-iv-1053/">Истиратели чашечные ИВ</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/kapeli-magnezitovye-mabor-1054/"> <span class="link-text">Капели магнезитовые MABOR</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/bloki-mnogomestnye-bullion-blocks-dlya-kupelirovaniya-1055/">Блоки многоместные Bullion Blocks для купелирования</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/kapeli-magnezitovye-mabor-dlya-analiza-bogatyh-rud-shlamov-zoly-skrapa-1056/">Капели магнезитовые MABOR для анализа богатых руд, шламов, золы, скрапа</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/kapeli-magnezitovye-mabor-dlya-analiza-gornyh-porod-mineralov-pri-soputstvuyushchey-dobyche-zolota-1057/">Капели магнезитовые MABOR для анализа горных пород, минералов, при сопутствующей добыче золота</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/kapeli-magnezitovye-mabor-dlya-analiza-splavov-i-slitkov-zolota-1058/">Капели магнезитовые MABOR для анализа сплавов и слитков золота</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/melnitsy-1059/"> <span class="link-text">Мельницы</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-nozhevye-rm-1060/">Мельницы ножевые РМ</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-sharovye-daihan-yuzhnaya-koreya-1061/">Мельницы шаровые Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-drobilki-vkmd-1062/">Мельницы-дробилки ВКМД</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/oborudovanie-fritsch-germaniya-1063/"> <span class="link-text">Оборудование Fritsch (Германия)</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/sita-analiticheskie-400%2F65-fritsch-germaniya-1359/">Сита аналитические 400/65 Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pitateli-vibratsionnye-fritsch-germaniya-1361/">Питатели вибрационные Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/analizatory-razmerov-chastits-fritsch-germaniya-1064/">Анализаторы размеров частиц Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/grohoty-vibratsionnye-fritsch-germaniya-1065/">Грохоты вибрационные Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/sita-pretsizionnye-100%2F40-fritsch-germaniya-1066/">Сита прецизионные 100/40 Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/sita-analiticheskie-200%2F50-fritsch-germaniya-1067/">Сита аналитические 200/50 Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/deliteli-obraztsov-fritsch-germaniya-1068/">Делители образцов Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/drobilki-shchekovye-fritsch-germaniya-1069/">Дробилки щековые Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-diskovye-fritsch-germaniya-1070/">Мельницы дисковые Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-perekrestno-otbivayushchie-fritsch-germaniya-1071/">Мельницы перекрестно-отбивающие Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/melnitsy-planetarnye-fritsch-germaniya-1072/"> <span class="link-text">Мельницы планетарные Fritsch (Германия)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/melnitsy-planetarnye-fritsch-germaniya-1358/">Мельницы планетарные Fritsch (Германия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/shary-melyushchie-dlya-planetarnyh-melnits-pulverisette-1360/">Шары мелющие для планетарных мельниц Pulverisette</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/stakany-razmolnye-12-45-ml-dlya-pulverisette-4-7-classic-line-1073/">Стаканы размольные (12, 45 мл) для Pulverisette 4, 7 classic line</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/stakany-razmolnye-20-45-80-ml-i-kryshki-dlya-pulverisette-7-premium-line-1074/">Стаканы размольные (20, 45, 80 мл) и крышки для Pulverisette 7 premium line</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/stakany-razmolnye-80-250-500-ml-i-kryshki-dlya-pulverisette-4-5-6-classic-line-1075/">Стаканы размольные (80, 250, 500 мл) и крышки для Pulverisette 4, 5, 6 classic line</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/melnitsy-rezhushchie-fritsch-germaniya-1076/"> <span class="link-text">Мельницы режущие Fritsch (Германия)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/melnitsa-rezhushchaya-laboratornaya-pulverisette-15-i-aksessuary-1077/">Мельница режущая лабораторная Pulverisette 15 и аксессуары</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/melnitsa-rezhushchaya-moshchnaya-pulverisette-25-i-aksessuary-1078/">Мельница режущая мощная Pulverisette 25 и аксессуары</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/melnitsa-rezhushchaya-universalnaya-pulverisette-19-i-aksessuary-1079/">Мельница режущая универсальная Pulverisette 19 и аксессуары</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-rotornye-fritsch-germaniya-1080/">Мельницы роторные Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/melnitsy-stupki-fritsch-germaniya-1081/">Мельницы-ступки Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/mikromelnitsy-vibratsionnye-fritsch-germaniya-1082/">Микромельницы вибрационные Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/minimelnitsy-fritsch-germaniya-1083/">Минимельницы Fritsch (Германия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/ultrazvukovye-vanny-fritsch-germaniya-1084/">Ультразвуковые ванны Fritsch (Германия)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/oborudovanie-dlya-rasseva-1085/">Оборудование для рассева</a>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/svch-mineralizatory-1086/">СВЧ-минерализаторы</a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/sita-laboratornye-1087/"> <span class="link-text">Сита лабораторные</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/sita-laboratornye-serii-d-1372/"> <span class="link-text">Сита лабораторные серии Д</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-120-h%3D38-mm-bronza-1373/">Сита лабораторные Д-120, h=38 мм (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-120-h%3D38-mm-latun-1374/">Сита лабораторные Д-120, h=38 мм (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-120-h%3D38-mm-n%2Fzh-stal--1375/">Сита лабораторные Д-120, h=38 мм (н/ж сталь) </a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-200-h%3D50-mm-bronza-1376/">Сита лабораторные Д-200, h=50 мм (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-200-h%3D50-mm-latun-1377/">Сита лабораторные Д-200, h=50 мм (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-200-h%3D50-mm-n%2Fzh-stal-1378/">Сита лабораторные Д-200, h=50 мм (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-200-h%3D50-mm-otsinkovannaya-stal-perforirovannaya-1379/">Сита лабораторные Д-200, h=50 мм (оцинкованная сталь, перфорированная)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-200-h%3D50-mm-otsinkovannaya-stal-shchelevidnye-otverstiya-1380/">Сита лабораторные Д-200, h=50 мм (оцинкованная сталь, щелевидные отверстия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-300-h%3D75-mm-bronza-1381/">Сита лабораторные Д-300, h=75 мм (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-300-h%3D75-mm-latun-1382/">Сита лабораторные Д-300, h=75 мм (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-300-h%3D75-mm-n%2Fzh-stal-1383/">Сита лабораторные Д-300, h=75 мм (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-300-h%3D75-mm-otsinkovannaya-stal-perforirovannaya-1384/">Сита лабораторные Д-300, h=75 мм (оцинкованная сталь, перфорированная)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-d-300-h%3D75-mm-otsinkovannaya-stal-shchelevidnye-otverstiya-1385/">Сита лабораторные Д-300, h=75 мм (оцинкованная сталь, щелевидные отверстия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/kryshki-poddony-dlya-sit-d-1088/">Крышки, поддоны для сит Д</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/sita-laboratornye-serii-s-1386/"> <span class="link-text">Сита лабораторные серии С</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sertifikaty-o-kalibrovke-sit-s-1387/">Сертификаты о калибровке сит С</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s12%2F38-bronza-1388/">Сита лабораторные С12/38 (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s12%2F38-latun-1389/">Сита лабораторные С12/38 (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s12%2F38-n%2Fzh-stal-1390/">Сита лабораторные С12/38 (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F38-bronza-1391/">Сита лабораторные С20/38 (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F38-latun-1392/">Сита лабораторные С20/38 (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F38-n%2Fzh-stal-1393/">Сита лабораторные С20/38 (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F50-bronza-1394/">Сита лабораторные С20/50 (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F50-latun-1395/">Сита лабораторные С20/50 (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F50-n%2Fzh-stal-1396/">Сита лабораторные С20/50 (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s20%2F100-n%2Fzh-stal-1397/">Сита лабораторные С20/100 (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s30%2F50-bronza-1398/">Сита лабораторные С30/50 (бронза)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s30%2F50-latun-1399/">Сита лабораторные С30/50 (латунь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s30%2F50-n%2Fzh-stal-1400/">Сита лабораторные С30/50 (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sita-laboratornye-s30%2F100-n%2Fzh-stal-1401/">Сита лабораторные С30/100 (н/ж сталь)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/kryshki-poddony-promezhutochnye-koltsa-dlya-sit-s-1089/">Крышки, поддоны, промежуточные кольца для сит С</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/stoly-vibratsionnye-1090/">Столы вибрационные</a>
                </li>
            </ul>
        </li>
        <li class="catalog-menu__item ">
            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/oborudovanie-obshchelaboratornoe-1091/"><span class="link-text">Оборудование общелабораторное</span> <span class="catalog-menu__count">(67)</span></a>
            <ul class="catalog-menu__list catalog-menu__list-level-1">
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/perekachivayushchie-ustroystva-1423/"> <span class="link-text">Перекачивающие устройства</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/nasosy-peristalticheskie-1424/">Насосы перистальтические</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/nasosy-vakuumnye-1416/"> <span class="link-text">Насосы вакуумные</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/nasosy-vakuumnye-vacuubrand-germaniya-1417/"> <span class="link-text">Насосы вакуумные Vacuubrand (Германия)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/nasosy-membrannye--me-do-70-mbar-vacuubrand-germaniya-1418/">Насосы мембранные ME (до 70 мбар) Vacuubrand (Германия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/nasosy-membrannye--mz-do-7-mbar-vacuubrand-germaniya-1419/">Насосы мембранные MZ (до 7 мбар) Vacuubrand (Германия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/nasosy-membrannye-md-do-15-mbar-vacuubrand-germaniya-1420/">Насосы мембранные MD (до 1,5 мбар) Vacuubrand (Германия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/nasosy-membrannye-mv-do-06-mbar-vacuubrand-germaniya-1421/">Насосы мембранные MV (до 0,6 мбар) Vacuubrand (Германия)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/sistemy-vakuumnye-pc-vacuubrand-germaniya-1422/">Системы вакуумные PC Vacuubrand (Германия)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vspomogatelnoe-oborudovanie-1407/"> <span class="link-text">Вспомогательное оборудование</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/sekundomery-mehanicheskie-1408/">Секундомеры механические</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shtativy-bunzena-1409/">Штативы Бунзена</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shtativy-dlya-delitelnyh-voronok-1410/">Штативы для делительных воронок</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shtativy-dlya-ionoselektivnyh-elektrodov-1411/">Штативы для ионоселективных электродов</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shtativy-dlya-pipetok-1412/">Штативы для пипеток</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shtativy-dlya-probirok-butirometrov-1413/">Штативы для пробирок, бутирометров</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/shtativy-dlya-hromatograficheskih-kolonok-1414/">Штативы для хроматографических колонок</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/avtoklavy-1092/"> <span class="link-text">Автоклавы</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/avtoklavy-daihan-yuzhnaya-koreya-1093/">Автоклавы Daihan (Южная Корея)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/akvadistillyatory-bidistillyatory-deionizatory-1094/"> <span class="link-text">Аквадистилляторы, бидистилляторы, деионизаторы</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/akvadistillyatory-bidistillyatory--otechestvennye-1095/">Аквадистилляторы, бидистилляторы отечественные</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/deionizatory-vodoley-1096/">Деионизаторы Водолей</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/analizatory-vlazhnosti-1097/"> <span class="link-text">Анализаторы влажности</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/analizatory-vlazhnosti-a%26d-yaponiya-1098/">Анализаторы влажности A&amp;D (Япония)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/analizatory-vlazhnosti-mettler-toledo-1099/">Анализаторы влажности Mettler Toledo</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/analizatory-vlazhnosti-ohaus-1100/">Анализаторы влажности Ohaus</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vesovaya-tehnika-1101/"> <span class="link-text">Весовая техника</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vesy-a%26d-yaponiya-1102/"> <span class="link-text">Весы A&amp;D (Япония)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/mikrovesy-vm-1103/">Микровесы ВМ</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-gh-1104/">Аналитические весы GH</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-gr-1105/">Аналитические весы GR</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-hr-az-1106/">Аналитические весы HR-AZ</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-hr-hr-a-1107/">Аналитические весы HR, HR-A</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/karmannye-vesy-hj-1108/">Карманные весы HJ</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/komparatory-massy-mc-1109/">Компараторы массы MC</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-dl-1110/">Лабораторные весы DL</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-dx-1111/">Лабораторные весы DX</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-ek-ew-1112/">Лабораторные весы EK, EW</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-gf-1113/">Лабораторные весы GF</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-gx-1114/">Лабораторные весы GX</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-em-1115/">Платформенные весы EM</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-fg-1116/">Платформенные весы FG</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-fs-1117/">Платформенные весы FS</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-gp-1118/">Платформенные весы GP</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-hv-1119/">Платформенные весы HV</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-hw-1120/">Платформенные весы HW</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-sc-1121/">Платформенные весы SC</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-se-1122/">Платформенные весы SE</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-sw-1123/">Платформенные весы SW</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portsionnye-vesy-hl-1124/">Порционные весы HL</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portsionnye-vesy-ht-1125/">Порционные весы HT</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portsionnye-vesy-np-1126/">Порционные весы NP</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portsionnye-vesy-sk-1127/">Порционные весы SK</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/schetnye-vesy-fc-1128/">Счетные весы FC</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vesy-cas-koreya-1129/"> <span class="link-text">Весы CAS (Корея)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-cauw-saux-1130/">Аналитические весы CAUW, СAUX</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/indikatory-cl-1131/">Индикаторы CL</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-cuw-cux-1132/">Лабораторные весы CUW, CUX</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-mw-mwii-mwp-1133/">Лабораторные весы MW, MWII, MWP</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/napolnye-vesy-dl-1134/">Напольные весы DL</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/napolnye-vesy-pb-1135/">Напольные весы PB</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/nastolnye-vesy-swii-sw-w-1136/">Настольные весы SWII, SW-W</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vesy-ohaus-ssha-1137/"> <span class="link-text">Весы Ohaus (США)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-adventurer-pro-av-1138/">Аналитические весы Adventurer Pro (AV)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-discovery-dv-1139/">Аналитические весы Discovery (DV)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-explorer-ex-1140/">Аналитические весы Explorer (EX)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-pioneer-pa-1141/">Аналитические весы Pioneer (PA)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/karmannye-vesy-pocket-scales-ya-1142/">Карманные весы Pocket scales (YA)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-adventurer-pro-av-1143/">Лабораторные весы Adventurer Pro (AV)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-explorer-ex-1144/">Лабораторные весы Explorer (EX)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-pioneer-pa-1145/">Лабораторные весы Pioneer (PA)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/platformennye-vesy-defender-d-1146/">Платформенные весы Defender (D)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portativnye-vesy-navigator-nv-nvl-nvt-1147/">Портативные весы Navigator (NV, NVL, NVT)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portativnye-vesy-scout-spu-sps-1148/">Портативные весы Scout (SPU, SPS)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/portativnye-vesy-traveler-ta-1149/">Портативные весы Traveler (TA)</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/promyshlennye-nastolnye-vesy-valor-v-1150/">Промышленные настольные весы Valor (V)</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/vesy-mettler-toledo-shveytsariya-1152/"> <span class="link-text">Весы Mettler Toledo (Швейцария)</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-ml-1154/">Аналитические весы ML</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-ms-1155/">Аналитические весы MS</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-xp-1156/">Аналитические весы XP</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-xpe-1157/">Аналитические весы XPE</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-xs-1158/">Аналитические весы XS</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/analiticheskie-vesy-xse-1159/">Аналитические весы XSE</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-ml-1161/">Лабораторные весы ML</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-ms-1162/">Лабораторные весы MS</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-xp-1163/">Лабораторные весы XP</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/laboratornye-vesy-xs-1164/">Лабораторные весы XS</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/prinadlezhnosti-k-vesam-mettler-toledo-1165/">Принадлежности к весам Mettler Toledo</a>
                                </li>
                            </ul>
                        </li>
                        <li class="catalog-menu__item ">
                            <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/giri-kalibrovochnye-1172/"> <span class="link-text">Гири калибровочные</span> </a>
                            <ul class="catalog-menu__list catalog-menu__list-level-3">
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/giri-kalibrovochnye-e2-1403/">Гири калибровочные E2</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/giri-kalibrovochnye-f1-1404/">Гири калибровочные F1</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/giri-kalibrovochnye-f2-1405/">Гири калибровочные F2</a>
                                </li>
                                <li class="catalog-menu__item">
                                    <a class="catalog-menu__link" href="/catalog/giri-kalibrovochnye-m1-1406/">Гири калибровочные M1</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item">
                    <a class="catalog-menu__link" href="/catalog/viskozimetry-vibratsionnye-a%26d-1173/">Вискозиметры вибрационные A&amp;D</a>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/gosudarstvennye-standartnye-obraztsy-gso-1174/"> <span class="link-text">Государственные стандартные образцы (ГСО)</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/gso-obshchey-zhestkosti-vody-1415/">ГСО общей жесткости воды</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/gso-sostava-rastvorov-anionov-1175/">ГСО состава растворов анионов</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/gso-sostava-rastvorov-kationov-1176/">ГСО состава растворов катионов</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/inkubatory-1184/"> <span class="link-text">Инкубаторы</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/inkubatory-daihan-yuzhnaya-koreya-1185/">Инкубаторы Daihan (Южная Корея)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/kolbonagrevateli-1186/"> <span class="link-text">Колбонагреватели</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/kolbonagrevateli-rossiya-1187/">Колбонагреватели (Россия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/kolbonagrevateli-daihan-yuzhnaya-koreya-1188/">Колбонагреватели Daihan (Южная Корея)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/peremeshivayushchie-ustroystva-1189/"> <span class="link-text">Перемешивающие устройства</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/ekstraktory-1427/">Экстракторы</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/flokulyatory-daihan-yuzhnaya-koreya-1425/">Флокуляторы Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/sheykery-rossiya-1426/">Шейкеры (Россия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/vorteksy-daihan-yuzhnaya-koreya-1190/">Вортексы Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/gomogenizatory-daihan-yuzhnaya-koreya-1191/">Гомогенизаторы Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/meshalki-verhneprivodnye-rossiya-1192/">Мешалки верхнеприводные (Россия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/meshalki-verhneprivodnye-daihan-yuzhnaya-koreya-1193/">Мешалки верхнеприводные Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/meshalki-magnitnye-rossiya-1194/">Мешалки магнитные (Россия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/meshalki-magnitnye-daihan-yuzhnaya-koreya-1195/">Мешалки магнитные Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/sheykery-vstryahivateli-daihan-yuzhnaya-koreya-1196/">Шейкеры, встряхиватели Daihan (Южная Корея)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/pechi-mufelnye-1197/"> <span class="link-text">Печи муфельные</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pechi-mufelnye-rossiya-1428/">Печи муфельные (Россия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pechi-mufelnye-daihan-yuzhnaya-koreya-1429/">Печи муфельные Daihan (Южная Корея)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pechi-trubchatye-snol-litva-1430/">Печи трубчатые Snol (Литва)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/pechi-mufelnye-snol-litva-1198/">Печи муфельные Snol (Литва)</a>
                        </li>
                    </ul>
                </li>
                <li class="catalog-menu__item ">
                    <a class="catalog-menu__link catalog-menu__link_type_folder" href="/catalog/plity-sushilnye-peschanye-bani-elektroplitki-1199/"> <span class="link-text">Плиты сушильные, песчаные бани, электроплитки</span> </a>
                    <ul class="catalog-menu__list catalog-menu__list-level-2">
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/plity-sushilnye-peschanye-bani-elektroplitki-rossiya-1431/">Плиты сушильные, песчаные бани, электроплитки (Россия)</a>
                        </li>
                        <li class="catalog-menu__item">
                            <a class="catalog-menu__link" href="/catalog/plity-sushilnye-elektroplitki-daihan-yuzhnaya-koreya-1200/">Плиты сушильные, электроплитки Daihan (Южная Корея)</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
<div class="catalog-summary">
    Всего <span class="catalog-summary__value">3 452</span> товара
</div>

<?/*
$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?><div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><h1
		class="<? echo $arCurView['TITLE']; ?>"
		id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"
	><a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>"><?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a></h1><?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<ul class="<? echo $arCurView['LIST']; ?>">
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_line_img"
					style="background-image: url(<? echo $arSection['PICTURE']['SRC']; ?>);"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
				></a>
				<h2 class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2><?
				if ('' != $arSection['DESCRIPTION'])
				{
					?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
				}
				?><div style="clear: both;"></div>
				</li><?
			}
			unset($arSection);
			break;
		case 'TEXT':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><h2 class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2></li><?
			}
			unset($arSection);
			break;
		case 'TILE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_tile_img"
					style="background-image:url(<? echo $arSection['PICTURE']['SRC']; ?>);"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
				> </a><?
				if ('Y' != $arParams['HIDE_SECTION_NAME'])
				{
					?><h2 class="bx_catalog_tile_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
					if ($arParams["COUNT_ELEMENTS"])
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
				?></h2><?
				}
				?></li><?
			}
			unset($arSection);
			break;
		case 'LIST':
			$intCurrentDepth = 1;
			$boolFirst = true;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (0 < $intCurrentDepth)
						echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
				}
				elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (!$boolFirst)
						echo '</li>';
				}
				else
				{
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
						$intCurrentDepth--;
					}
					echo str_repeat("\t", $intCurrentDepth-1),'</li>';
				}

				echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
				?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><h2 class="bx_sitemap_li_title"><a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
				if ($arParams["COUNT_ELEMENTS"])
				{
					?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
				}
				?></a></h2><?

				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1)
			{
				echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0)
			{
				echo '</li>',"\n";
			}
			break;
	}
?>
</ul>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?></div>
*/?>