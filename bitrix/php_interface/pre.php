<?
// http://code.google.com/p/preview-array/downloads/list

function get_css_TopRight_radius( $radius )   { return '-moz-border-radius-topright:'.$radius.';    -webkit-border-top-right-radius: '.$radius.';'; }
    function get_css_TopLeft_radius( $radius )    { return '-moz-border-radius-topleft:'.$radius.';     -webkit-border-top-left-radius: '.$radius.';';  }
    function get_css_BottomRight_radius( $radius ){ return '-moz-border-radius-bottomright:'.$radius.'; -webkit-border-bottom-right-radius: '.$radius.';'; }
    function get_css_BottomLeft_radius( $radius ) { return '-moz-border-radius-bottomleft:'.$radius.';  -webkit-border-bottom-left-radius: '.$radius.';'; }

    function get_css_Right_radius( $radius ){ return get_css_TopRight_radius( $radius ).' '.get_css_BottomRight_radius( $radius );  }
    function get_css_Left_radius( $radius ) { return get_css_TopLeft_radius( $radius ).'  '.get_css_BottomLeft_radius( $radius );  }

    function get_all_radius( $radius ) {  return get_css_Right_radius( $radius ).' '.get_css_Left_radius( $radius ); }



    function show_var($value)
    {
        $numeric_text_color = '#53C8F4';
        $numeric_background_color = '#E5F6FD';
        $numeric_style='style="color:'.$numeric_text_color.'; background-color:'.$numeric_background_color.'; '.get_all_radius( '4px' ).'; border:1px solid '.$numeric_text_color.';"';

        $string_text_color = '#9EE238';
        $string_background_color = '#E9FAD0';
        $string_style='style="color:'.$string_text_color.'; background-color:'.$string_background_color.'; '.get_all_radius( '4px' ).'; border:1px solid '.$string_text_color.';  line-height: 20px;"';

        $bool_text_color = '#FF33FF';
        $bool_background_color = '#FFCCFF';
        $bool_style='style="color:'.$bool_text_color.'; background-color:'.$bool_background_color.'; '.get_all_radius( '4px' ).'; border:1px solid '.$bool_text_color.';"';

        $empty_text_color = '#000000';
        $empty_background_color = '';
        $empty_style='style="color:'.$empty_text_color.'; background-color:'.$empty_background_color.'; '.get_all_radius( '4px' ).'; font-style: italic;"';

        $default_text_color = '#004400';
        $default_background_color = '#00FF00';
        $default_style='style="color:'.$default_text_color.'; background-color:'.$default_background_color.'; '.get_all_radius( '4px' ).'"';


	// http://studio.bashnet.ru/rukovodstvo/php/datafun/type.php

        if( is_bool($value) ) return '<font '.$bool_style.'>&nbsp;'.( ($value) ? '<b>TRUE</b>' : '<b>FALSE</b>' ).'&nbsp;</font>';

        elseif(is_string($value)) return '<font '.$string_style.'>&nbsp;\''.htmlspecialchars($value).'\'&nbsp;</font>';

        elseif( is_numeric($value)) return '<font '.$numeric_style.'>&nbsp;'.$value.'&nbsp;</font>';

        elseif( empty($value) ) return '<font '.$empty_style.'>&nbsp;Empty&nbsp;</font>';

	elseif( is_resource($value) ) return '<font '.$default_style.'>&nbsp;'.get_resource_type($value). '&nbsp;:&nbsp;'. $value.'&nbsp;</font>';
	
        else return  '<font '.$default_style.'>&nbsp;'.$value.'&nbsp;</font>';
    }


    function get_script($hash_key) { return "if( getElementById('".$hash_key."').style.display != 'none' ){ getElementById('".$hash_key."').style.display = 'none' }else{ getElementById('".$hash_key."').style.display = 'block' } return false;   ";}

    function _pre($mixed, $depth=0)
    {
	$out_message='';
        $style_array_text = 'style="cursor: pointer"';
        $style_array_empty_text = 'style=""';
        $style_space = 'padding-left: 20px; padding-right: 4px;';
        $style_color = 'color: #444444; border: #444444 1px solid; background-color: RGB('.intval(255-24*($depth+1)).','.intval(255-24*($depth+1)).','.intval(255-24*($depth+1)).'); '.get_all_radius('8px');

        if($depth==0){
		$out_message .= '<table cellspacing="0" cellpadding="4" border="0"><tr><td><div style="color: #444444; border: #111111 2px solid; background-color: RGB(255,255,255); padding:4px; '.get_all_radius('8px').'">';
		try{throw new Exception;}catch(Exception $e){
			$trace = $e->getTrace();
			$out_message .= $trace[1]['file']. ':'. $trace[1]['line'];
		};
	}

            if(is_object($mixed)){
		$mixed = Array(
			'class '.get_class($mixed) => Array(
				'methods' => get_class_methods($mixed),
				'vars' => get_object_vars($mixed),
			)
		);
	    }

	    if( !is_array( $mixed ) ){
                $out_message .=  '<table cellspacing="0" cellpadding="1" border="0" style="margin: 0; padding:0px;"><tr><td>';
                $out_message .= show_var($mixed);
                $out_message .= '</td></tr></table>';
            }else{
		if(!count($mixed)){
			$out_message .= '&nbsp;Empty array&nbsp;';
		}else foreach( $mixed as $key => $value )
                {
                    if( is_array($value) )
                    {
                            $hash_key = 'div_'.intval( rand(1, 100000) );
                            $count_items_in_value = count($value);
                            $out_message .=
                            '<table cellspacing="0" cellpadding="1" border="0" style="margin: 0;">
                              <tr>
                                <td colspan='.($depth+2).'>

                                    <table cellspacing="0" cellpadding="0" border="0" style="margin: 0; padding:0px;">
                                        <tr>
                                            <td><b>&nbsp;'.$key.'</b> => </td><td><div '.$style_array_text.' onclick="'.get_script($hash_key).'">Array ('.$count_items_in_value.')&nbsp;</div></td>
                                        </tr>
                                    </table>';

                                    if($count_items_in_value) $out_message .= '<div name="'.$hash_key.'" id="'.$hash_key.'" style="'.$style_space.'"><div  style="'.$style_color.'">'._pre($value, $depth+1 ).'</div></div>';

                            $out_message .=
                                '</td>
                              </tr>
                            </table>';
                    }
                    else
                    {
                        $out_message .=  '<table cellspacing="0" cellpadding="1" border="0" style="margin: 0; padding:0px;"><tr><td><b>&nbsp;'.$key.'</b> => ';
                        $out_message .= show_var($value);
                        $out_message .= '&nbsp;</td></tr></table>';
                    }
                }
            }

        if($depth==0) $out_message .= '</div></td></tr></table>';


        if($depth==0) { echo $out_message; return; }
        return $out_message;
    }


function pre(){
	foreach(func_get_args() as $arg)_pre($arg);
}
?>