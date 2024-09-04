<?php 
    function test_input($data){
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    };
    
    function subHyphen($variable) {
      // Find the position of the first occurrence of "By"
      $position = strpos($variable, "-");
  
      // If "By" is found in the string
      if ($position !== false) {
          // Extract the substring from the beginning of the string up to the position of "By"
          return substr($variable, 0, $position);
      }
  
      // If "By" is not found, return the original string
      return $variable;
  }

?>