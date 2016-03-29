<?php 
function getCourseLeader($institutionCode, $courseId, $user, $query){
	$courseStaffList = $query->courseStaffList($institutionCode, $courseId);
		if (!$courseStaffList){ 
			return false; 
		}else{
			foreach ($courseStaffList as $row){
				if ($row->role == 'leader'){
					$name = $query->courseStaffName($row->staff_id, $institutionCode);
					$username = $query->getUsername($row->staff_id);
				}
			}
			return array($name, $username);
	    }
}