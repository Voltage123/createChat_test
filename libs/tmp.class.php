<?php
/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-08 23:27:35
 * @version 1
 */

class tmp 
{
  private $path;
  private $variables = array();
  public function __construct(){
      $this->path = ROOT."/tmp";
  }

  /**
   * Присваивание переменных в шаблоне
   * @param $name <string> 
   * @param $value <mixed>
   * 
   */
  
  public function assign($name, $value){
      $this->variables[$name] = $value;
  }
  
  public function show_display($file_include){
      if(!file_exists($this->path.'/'.$file_include)){
          throw new Exception("Файл шаблона не найден!");
      }
      require_once $this->path.'/'.$file_include;
  }
  public function __get($name){
     if(isset($this->variables[$name])){
         $variable = $this->variables[$name];
         
         return $variable;
     } 
     return false;
  }
  
}