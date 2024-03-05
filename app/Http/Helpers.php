<?php


  function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->role);
    foreach ($permissions as $key => $value) {
      if($value == $userAccess){
        return true;
      }
    }
    return false;
  }


  function getMyPermission($id)
  {
    switch ($id) {
        case 'Admin':
          return 'Admin';
          break;
          case 'Superadmin':
            return 'Superadmin';
            break;
      case 'Editor':
        return 'Editor';
        break;
      case 'Author':
        return 'Author';
        break;
      default:
        return 'user';
        break;
    }
  }


?>
