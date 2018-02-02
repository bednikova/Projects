<?php


namespace App\Model;

use Pragmatic\Model as Model;

/**
 * Description of Skills
 *
 * @author bednikova
 */
class Skills extends Model{
    
    /**
	 * Regular expression for validate Category Name
	 * var string
	 */
	const VALID_NAME_REGEX = '^[A-Za-z+#]*$';
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'skills';

	/**
	 * An array of all properties, which need to be unique
	 * @var Array
	 */
	//protected static $uniqueProperties = array('name');
	
	/**
	 * The Name of the Skills
	 * @var string
	 */
	protected $language;
        protected $level;
        protected $experience;

        
        public function getLanguage() {
            return $this->language;
        }

        public function getLevel() {
            return $this->level;
        }

        public function getExperience() {
            return $this->experience;
        }

        public function setLanguage($language) {
            if ( !$this->validate('language', $language) ) {
		return false;
            }
            $this->language = $language;
            return $this;
        }

        function setLevel($level) {
            if ( !$this->validate('level', $level) ) {
		return false;
            }
            $this->level = $level;
            return $this;
        }

        function setExperience($experience) {
            $this->experience = $experience;
            return $this;
        }


    
	
}
