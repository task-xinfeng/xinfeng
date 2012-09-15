<?php
App::uses('ClassRegistry', 'Utility');
App::uses('AppHelper', 'View/Helper');
class StringUtilHelper extends AppHelper  {

    function sysSubStr($String,$Length,$Append = true)
	{
		$String = strip_tags($String);
		if (strlen($String) <= $Length )
		{
			return $String;
		}
		else
		{
			$I = 0;
			while ($I < $Length)
			{
				$StringTMP = substr($String,$I,1);
				if ( ord($StringTMP) >=224 )
				{
					$StringTMP = substr($String,$I,3);
					$I = $I + 3;
				}
				elseif( ord($StringTMP) >=192 )
				{
					$StringTMP = substr($String,$I,2);
					$I = $I + 2;
				}
				else
				{
					$I = $I + 1;
				}
				$StringLast[] = $StringTMP;
			}
			$StringLast = implode("",$StringLast);
			if($Append)
			{
				$StringLast .= "...";
			}
			return $StringLast;
		}
	}
	
	/** 
     * 格式化金额 
     * 
     * @param int $money 
     * @param int $len 
     * @param string $sign 
     * @return string 
     */  
    function formatMoney($money, $len=2, $sign='￥'){  
        $negative = $money >= 0 ? '' : '-';  
        $int_money = intval(abs($money));  
        $len = intval(abs($len));  
        $decimal = '';//小数  
        if ($len > 0) {  
            $decimal = '.'.substr(sprintf('%01.'.$len.'f', $money),-$len);  
        }  
		$format_money = '';
        $tmp_money = strrev($int_money);  
        $strlen = strlen($tmp_money);  
        for ($i = 3; $i < $strlen; $i += 3) {  
            $format_money .= substr($tmp_money,0,3).',';  
            $tmp_money = substr($tmp_money,3);  
        }  
        $format_money .= $tmp_money;  
        $format_money = strrev($format_money);  
        return $sign.$negative.$format_money.$decimal;  
    }  
      
    //echo format_money(1154.0616);  
    
	function toDate($datetime){
		if(empty($datetime)){
			return '-';
		}
		return date("Y-m-d", strtotime($datetime));
	}
}
?>
