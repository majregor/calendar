<?php
  

    function saveUserSubDistrict($subDistrictId, $userId){
      try{
        $query = "insert into tbl_user_sub_district values(0, $subDistrictId, $userId)";
        save($query);
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function updateUserSubDistrict($id, $subDistrictId, $userId){
      try{
        $query = "update tbl_user_sub_district set sub_district_id = $subDistrictId, user_id = $userId where id = $id";
        save($query);
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function deleteUserSubDistrict($id){
      try{
        $query = "delete from tbl_user_sub_district where id = $id";
        save($query);
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function getAllUserSubDistricts(){
      try{
        $query = "select * from tbl_user_sub_district";
        $result = read($query);
        return $result;
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function getUserSubDistrict($id){
      try{
        $query = "select * from tbl_user_sub_district where id = $id";
        $result = read($query);
        $resultRow = mysql_fetch_object($result);
        return $resultRow;
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function getSubDistrictInfoForUser($userId){
      try{
        $query = "select * from tbl_user_sub_district where user_id = $userId";
        $result = read($query);
        $resultRow = mysql_fetch_object($result);
        return $resultRow;
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function updateUserSubDistrictForUser($userId, $subDistrictId){
      try{
        $query = "update tbl_user_sub_district set sub_district_id = $subDistrictId where user_id = $userId";
        save($query);
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function deleteUserSubDistrictForThisUser($userId){
      try{
        $query = "delete from tbl_user_sub_district where user_id = $userId";
        save($query);
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }

    function doesThisUserHasExistingUserSubDistrictRecord($userId){
      try{
        $cntVal = 0;
        $query = "select count(*) as cnt from tbl_user_sub_district where user_id = $userId";
        $result = read($query);
        $resultRow = mysql_fetch_object($result);
        $cntVal = $resultRow->cnt;
        if($cntVal){
          return true;
        }else{
          return false;
        }
      }catch(Exception $ex){
        $ex->getMessage();
      }
    }
?>
