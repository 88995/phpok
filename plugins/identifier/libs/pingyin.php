<?php

/*
	[THEN CMS] (C) 2000-2010 ����.
	$Id: pinyin.class.php 001 2009-3-16 03:16:32Z ���� $
  QQ:657653135; EMAIL:657653135@qq.com.
*/

class pingyin{

  /*
  �Ƿ�ƴ���ļ���ȡ���ڴ��ڣ���������ڴ�,����KB�����ӣ��ٶȿ�������������
  */
  var $isMemoryCache = 1;

  /*
  �Ƿ�ֻ��ȡ����ĸ
  */
  var $isFrist = 0;

 	/*
 	ƴ�������ļ���ַ
 	*/
	var $path = "py.qdb";

  /*
  �ڴ�ƴ������
  */
  var $MemoryCache;

  /*
   ƴ���ļ����
  */
  var $handle;

	/*
	ת�������������
	*/
  var $errorMsgBox;

  /*
  ת�����
  */
  var $result;


  var $array = array();
	var $n_t = array("��" => "a","��" => "a","��" => "a","��" => "a","��" => "a",
	  "��" => "o","��" => "o","��" => "o","��" => "o",
	  "��" => "e","��" => "e","��" => "e","��" => "e","��" => "e",
	  "��" => "i","��" => "i","��" => "i","��" => "i",
	  "��" => "u","��" => "u","��" => "u","��" => "u",
	  "��" => "v","��" => "v","��" => "v","��" => "v","��" => "v"
	);

	/*
	ת�����
  @params $str ����ת���ַ�,$isToneMark �Ƿ�������  $suffix β׺,Ĭ��Ϊ�ո�
  */
  function ChineseToPinyin($str,$isToneMark = 0,$suffix = ""){
    $this->py($str,$isToneMark,$suffix);
    return $this -> result;
  }

  function get(){
  	return $this -> result;
  }


  function py($str,$n = 0,$s = ""){
    $strLength = strlen($str);
		if($strLength == 0){ return "";  }
  	$this->result = "";
    if(is_array($str)){
      foreach($str as $key => $val){
		    $str[$key] = $this->py($val,$n,$s);
		  }
		  return;
		}

    if(empty($this->handle)){
	    if(!file_exists($this->path)){
	      $this->addOneErrorMsg(1,"ƴ���ļ�·��������");
	      return false;

		  }

      if(is_array($str)){
		    foreach($str as $key => $val){
		      $str[$key] = $this->py($val,$n,$s);
		    }
	    }


      if($this -> isMemoryCache){
        if(!$this->memoryCache){
    	    $this->memoryCache = file_get_contents($this->path);
		      for($i = 0 ; $i < $strLength ; $i++){
            $ord1 = ord(substr($str,$i,1));
            if($ord1 > 128){
              $ord2 = ord(substr($str, ++$i, 1));
              if(!isset($this->array[$ord1][$ord2])){
                $leng = ($ord1 - 129) * ((254 - 63) * 8 + 2) + ($ord2 - 64) * 8;
                $this->array[$ord1][$ord2] = trim(substr($this->memoryCache,$leng,8));
              }
              $strtrLen = $this->isFrist ? 1 : 8;
              $this->result .= substr($this ->array[$ord1][$ord2],0,$strtrLen).$s;
      }else{
        $this->result .= substr($str,$i,1);
      }

    }
        }
      }else{
        $this->handle = fopen($this->path,"r");
		    for($i = 0 ; $i < $strLength ; $i++){
          $ord1 = ord(substr($str,$i,1));
          if($ord1 > 128){
            $ord2 = ord(substr($str, ++$i, 1));
            if(!isset($this->array[$ord1][$ord2])){
              $leng = ($ord1 - 129) * ((254 - 63) * 8 + 2) + ($ord2 - 64) * 8;
              fseek($this -> handle,$leng);
                $this->array[$ord1][$ord2] = trim(fgets($this->handle,8));

            }
          $strtrLen = $this->isFrist ? 1 : 8;

          $this->result .= substr($this ->array[$ord1][$ord2],0,$strtrLen).$s;
        }else{ $this->result .= substr($str,$i,1); }

        }
      }

    if(!$n){ $this -> result = strtr($this -> result,$this -> n_t);}
    }
  }
   function addOneErrorMsg($No,$reason){

    $this->errorMsgBox[] = "<b>Error:</b>" . $No . "," . $reason;
  }

  function showErrorMsg(){

    foreach($this->errorMsgBox as $val){
      echo $val."\r\n\r\n</br></br>";
    }
  }

  function __destruct(){
    if(is_array($this->errorMsgBox)){
  	  $this->showErrorMsg();
  	}
  }

}

?>
