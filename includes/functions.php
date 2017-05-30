<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name){
  echo "hhhhhhhhhhhhhhh";
}

function include_layouts_template($template){
  include('../layouts/'.$template);
}
function include_layouts_template_n($template){
  include('layouts/'.$template);
}

function log_action($action="",$message=""){
    $log_file = $_SERVER["DOCUMENT_ROOT"]."/php17/logs/log.txt";

    if($handle = fopen($log_file, "a")){
      $timesnap = strftime("%Y-%m-%d %H:%M:%S",time());
      $content = $timesnap." | ".$action.":".$message."\n";
      fwrite($handle, $content);
      fclose($handle);
    }else{
      echo "Log file not found.";
    }

}
?>