<?php

class Query {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName;
	public $lastInsert;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('sessions/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Logout
                }
            }
        } else {
            $this->find($user);
        }
    }
	
	public function deleteFeedReply($id) {
        if(!$this->_db->delete('feed_replies', array('id', '=', $id), '')) {
            throw new Exception('');
        }
    }
	
	public function deleteMainFeedPost($id) {
        if(!$this->_db->delete('main_feed', array('id', '=', $id), '')) {
            throw new Exception('');
        }
    }
	
	public function deleteCourseStaff($id) {
        if(!$this->_db->delete('course_staff', array('id', '=', $id), '')) {
            throw new Exception('');
        }
    }
	
	public function deleteStaff($id) {
        if(!$this->_db->delete('staff', array('id', '=', $id), '')) {
            throw new Exception('');
        }
    }
	
	public function deleteStudent($id) {
        if(!$this->_db->delete('student', array('id', '=', $id), '')) {
            throw new Exception('');
        }
    }
	
	public function deleteMember($id) {
        if(!$this->_db->delete('users', array('id', '=', $id), '')) {
            throw new Exception('');
        }
    }
	

    public function create($fields = array()) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			return $this->_db->_insertId;
		}
    }
	
	 public function modulePost($fields = array()) {
        if(!$this->_db->insert('module_feed', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			return $this->_db->_insertId;
		}
    }
	
	 public function postToFeed($fields = array()) {
        if(!$this->_db->insert('main_feed', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			return $this->_db->_insertId;
		}
    }
	
	public function feedReply($fields = array()) {
        if(!$this->_db->insert('feed_replies', $fields)) {
            throw new Exception('error');
        }else{
			return $this->_db->_insertId;
		}
    }
	
	 public function modulePostComment($fields = array()) {
        if(!$this->_db->insert('module_feed_comments', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			return $this->_db->_insertId;
		}
    }
	
	public function createInstitution($fields = array()) {
        if(!$this->_db->insert('institutions', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			//return var_dump($this->_db->_insertId); this returns last insert id
		}
    }
	
	public function addStaff($fields = array()) {
        if(!$this->_db->insert('course_staff', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			//return var_dump($this->_db->_insertId); this returns last insert id
		}
    }
	
		public function createCourse($fields = array()) {
        if(!$this->_db->insert('courses', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			//return var_dump($this->_db->_insertId); this returns last insert id
		}
    }
	
		public function createModule($fields = array()) {
        if(!$this->_db->insert('modules', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			//return var_dump($this->_db->_insertId); this returns last insert id
		}
    }
	
	public function createStudentRecord($fields = array()) {
        if(!$this->_db->insert('student', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			//return var_dump($this->_db->_insertId); this returns last insert id
		}
    }
	
	public function createStaffRecord($fields = array()) {
        if(!$this->_db->insert('staff', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }else{
			//return var_dump($this->_db->_insertId); this returns last insert id
		}
    }



	
	 public function getModuleFeed($code, $parentMod) {
        $feed = $this->_db->get('module_feed', array('institution_id', '=', $code), ' AND parent_module_id = "' . $parentMod . '" ORDER BY id DESC');
        if($feed->count()) {
           $feedResults =  (array) $feed->resultArray();
		   
		   $parsedResults = [];
			
			//this is a far from ideal solution which queries each result of the above query to bind the user to it, a join query would be much more efficiant
			foreach ($feedResults as $row)
			{
				$row = (array) $row;
				
				$user = $this->_db->get('users', ['institution_code', '=', $code], 'AND id="' . $row['user_id'] . '"');
				
				$user = (array) $user->resultArray()[0];
				
				$row['user'] = [
					'first_name' => $user['first_name'],
					'name' => $user['name'],
					'last_name' => $user['last_name'],
					'username' => $user['username']
				];
				
				
				$parsedResults[] = $row;
			}
			
			$data['data'] = ['feed' => $parsedResults];
			$data['data']['current_user'] = ['id' => $this->data()->id];
			
            return json_encode($data);
        }
		
		
        return [];
    }
	
	public function getModuleFeedComments($code, $parentPost) {
        $feed = $this->_db->get('module_feed_comments', array('institution_code', '=', $code), ' AND parent_post_id = "' . $parentPost . '" ORDER BY id DESC');
        if($feed->count()) {
           $feedResults =  (array) $feed->resultArray();
		   
		   $parsedResults = [];
			
			//this is a far from ideal solution which queries each result of the above query to bind the user to it, a join query would be much more efficiant
			foreach ($feedResults as $row)
			{
				$row = (array) $row;
				
				$user = $this->_db->get('users', ['institution_code', '=', $code], 'AND id="' . $row['user_id'] . '"');
				
				$user = (array) $user->resultArray()[0];
				
				$row['user'] = [
					'first_name' => $user['first_name'],
					'name' => $user['name'],
					'last_name' => $user['last_name'],
					'username' => $user['username']
				];
				
				$parsedResults[] = $row;
			}
			
			$data['data'] = ['feed' => $parsedResults];
			$data['data']['current_user'] = ['id' => $this->data()->id];
			
            return json_encode($data);
        }
		
		
        return [];
    }
	
	
	
	public function getAdminCourses($id){
		 $replies = $this->_db->get('course_staff', array('staff_id', '=', $id), ' ');
		 if($replies->count()) {
			 $returnReplies = $replies->resultArray();
			 return $returnReplies;
		 }else{
		 	return false;
		 }
	}
	
	public function getFeedReplies($id){
		 $replies = $this->_db->get('feed_replies', array('parent_post_id', '=', $id), ' ORDER BY date ASC ');
		 if($replies->count()) {
			 $returnReplies = $replies->resultArray();
			 return $returnReplies;
		 }else{
		 	return false;
		 }
	}
	
	public function getMainFeed($code, $course){
		 $feed = $this->_db->get('main_feed', array('institution_code', '=', $code), ' AND course_code = "' . $course . '" ORDER BY ID DESC');
		 if($feed->count()) {
			 $returnFeed = $feed->resultArray();
			 return $returnFeed;
		 }else{
		 	return false;
		 }
	}

	public function getInsitutionName($code){
		 $name = $this->_db->get('institutions', array('code', '=', $code), '');
		 if($name->count()) {
			 $i_name = ($name->first()->name);
			 return $i_name;
		 }else{
			 return false;
		 }
	}
	
	public function getCourseId($code, $course){
		 $name = $this->_db->get('courses', array('institution_code', '=', $code), ' AND course = "' . $course . '"');
		 if($name->count()) {
			 $i_name = ($name->first()->course_id);
		 }
		 return $i_name;
	}
	
	public function getStudentYear($id){
		 $name = $this->_db->get('student', array('user_id', '=', $id), '');
		 if($name->count()) {
			 $i_name = ($name->first()->year);
		 }
		 return $i_name;
	}
	
	public function getInsitutionCourses($code){
		 $courses = $this->_db->get('courses', array('institution_code', '=', $code), ' ORDER BY course');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }	
	}
	
		public function getCourseModules($code, $courseId){
		 $courses = $this->_db->get('modules', array('institution_code', '=', $code), ' AND parent_course_code = "' . $courseId . '" ORDER BY module_year');
		 if($courses->count()) {
			$i_courses = $courses->resultArray();
			 return $i_courses;
		 }else{
			return false;	 
		 }
	}
	
	public function courseInfo($code, $courseId){
		 $courses = $this->_db->get('courses', array('institution_code', '=', $code), ' AND course_id = "' . $courseId . '"');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }	
	}
	
		public function moduleInfo($code, $modCode){
		 $courses = $this->_db->get('modules', array('institution_code', '=', $code), ' AND module_code = "' . $modCode . '"');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }	
	}
	
	public function courseStaffList($code, $courseId){
		 $courses = $this->_db->get('course_staff', array('institution_code', '=', $code), ' AND course_code = "' . $courseId . '"');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }else{
			return false;	 
		 }
	}
	
	public function staffList($code){
		 $courses = $this->_db->get('staff', array('institution_id', '=', $code), '');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }
		 
	}
	
	public function studentList($code){
		 $courses = $this->_db->get('student', array('institution_id', '=', $code), '');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }
		 
	}
	
	public function facultyList($code){
		 $courses = $this->_db->get('course_staff', array('course_code', '=', $code), '');
		 if($courses->count()) {
			 $i_courses = $courses->resultArray();
			 return $i_courses;
		 }
		 
	}
	
	public function studentName($id, $code){
		 $courses = $this->_db->get('users', array('institution_code', '=', $code), ' AND id = "' . $id . '"');
		 if($courses->count()) {
			 $i_courses = $courses->first()->name;
			 return $i_courses;
		 }	
	}
	
	
	public function courseStaffName($staffID, $code){
		 $courses = $this->_db->get('users', array('institution_code', '=', $code), ' AND id = "' . $staffID . '"');
		 if($courses->count()) {
			 $i_courses = $courses->first()->first_name . ' ' . $courses->first()->last_name;
			 return $i_courses;
		 }	
	}
	
	public function getUsername($id){
		 $courses = $this->_db->get('users', array('id', '=', $id), ' ');
		 if($courses->count()) {
			 $i_courses = $courses->first()->username;
			 return $i_courses;
		 }	
	}
	
	public function courseCount($code){
		$courses = $this->_db->get('courses', array('institution_code', '=', $code), '');
		 return $courses->count();	
	}
	
	public function enrollmentCount($institution_id, $code){
		$courses = $this->_db->get('student', array('institution_id', '=', $institution_id), ' AND course = "' . $code . '"');
		 return $courses->count();	
	}

	
	public function getStudentCourses($studentID, $code){
		 $course = $this->_db->get('student', array('user_id', '=', $studentID), '');
		 if($course->count()) {
			 $i_course = ($course->first()->course);
		 }
		 
		 $translate = $this->_db->get('courses', array('institution_code', '=', $code), '');
		 if($translate->count()) {
			 $i_translate = $translate->resultArray();
		 }
		 
		 foreach($i_translate as $row) {
                    if ($row->course_id == $i_course){
						$name = $row->course;
						
					}
                 }
		 
		return $name;
	}
	
	public function getStudentCourseId($studentID, $code){
		 $course = $this->_db->get('student', array('user_id', '=', $studentID), '');
		 if($course->count()) {
			 $i_course = ($course->first()->course);
		 }
	
		 
		return $i_course;
	}

 public function data(){
        return $this->_data;
   }
	
	public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user), '');

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
	
  

}