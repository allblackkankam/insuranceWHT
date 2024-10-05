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

    function getMonth($string) {
      // Split the string by the hyphen
      $parts = explode("-", $string);
      $modified_string = isset($parts[1]) ? $parts[1] : $string;
      $monthname = date('F', mktime(0, 0, 0, $modified_string, 10));
      
      return $monthname;
    }

    $allowedRoles = [1, 2, 3, 4];
    // Function to check user's role and sign out if not authorized
    function checkUserRole($allowedRoles) {
      // Assuming user's role is stored in session
      if (!isset($_SESSION['user_role'])) {
          // If the user role is not set, sign out
          header("location:/");
      }

      $userRole = $_SESSION['user_role'];

      // Check if user's role is in the allowed roles
      if (!in_array($userRole, $allowedRoles)) {
          // If user role is not allowed, sign out
          header("location:/");
      }
    }

    function isRoleAllowed($allowedRoles) {
      // Assuming user's role is stored in session
      if (!isset($_SESSION['user_role'])) {
          return false; // If user role is not set, don't allow access to content
      }
  
      $userRole = $_SESSION['user_role'];
  
      // Check if the user's role is in the allowed roles array
      return in_array($userRole, $allowedRoles);
  }
  
  // Example roles to be allowed for specific content
  $superRoles = [1];
  $adminRoles = [2]; // Role 1 is admin
  $officerRoles = [3]; // Roles 2 and 3 are editors
  $cleckRoles = [4]; // Role 4 is a regular user

?>