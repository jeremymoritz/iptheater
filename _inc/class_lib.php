<?php	//	classes

class Performance {
	//	PROPERTIES
	private $id;
	private $dateTime;

	//	CONSTRUCTOR
	function __construct($id = null, $dateTime = '2000-01-01 00:00:00') {
		$this->setId($id);
		$this->setDateTime($dateTime);
	}

	//	GETTERS
	public function getId() {return $this->id;}
	public function getDateTime() {return $this->dateTime;}

	//	SETTERS
	public function setId($id) {$this->id = intval($id);}
	public function setDateTime($dateTime) {$this->dateTime = $dateTime;}

	//	METHODS
	public function getDateTimeFormatted() {return date('ga \o\n D, M j, Y', strtotime($this->getDateTime()));}
	public function getDate() {return date('Y-m-d', strtotime($this->getDateTime()));}
}

class Show {
	//	PROPERTIES
	private $id;
	private $title;
	private $abbr;
	private $performances = array();

	//	CONSTRUCTOR
	function __construct($id = null, $title = null, $abbr = null, $performances = array()) {
		$this->setId($id);
		$this->setTitle($title);
		$this->setAbbr($abbr);
		$this->setPerformances($performances);
	}

	//	GETTERS
	public function getId() {return $this->id;}
	public function getTitle() {return $this->title;}
	public function getAbbr() {return $this->abbr;}
	public function getAbbrLower() {return strtolower($this->getAbbr());}
	public function getAbbrUpper() {return strtoupper($this->getAbbr());}
	public function getPerformances() {return $this->performances;}

	//	SETTERS
	public function setId($id) {$this->id = intval($id);}
	public function setTitle($title) {$this->title = $title;}
	public function setAbbr($abbr) {$this->abbr = $abbr;}
	public function setPerformances(array $performances) {$this->performances = $performances;}

	//	METHODS
	public function addPerformance(Performance $performance) {$this->performances[] = $performance;}
	public function getPerformance($performanceId) {
		$chosenPerformance = null;
		foreach($this->getPerformances() as $performance) {
			if($performance->getId() === intval($performanceId)) {
				$chosenPerformance = $performance;
				break;
			}
		}
		return $chosenPerformance;
	}
}

class Seat {
	//	PROPERTIES
	private $id;
	private $number;
	private $coordX;
	private $coordY;
	private $price;

	//	CONSTRUCTOR
	function __construct($id = null, $number = null, $coordX = null, $coordY = null, $price = 0) {
		$this->setId($id);
		$this->setNumber($number);
		$this->setCoordX($coordX);
		$this->setCoordY($coordY);
		$this->setPrice($price);
	}

	//	GETTERS
	public function getId() {return $this->id;}
	public function getNumber() {return $this->number;}
	public function getCoordX() {return $this->coordX;}
	public function getCoordY() {return $this->coordY;}
	public function getPrice() {return $this->price;}

	//	SETTERS
	public function setId($id) {$this->id = intval($id);}
	public function setNumber($number) {$this->number = $number;}
	public function setCoordX($coordX) {$this->coordX = $coordX;}
	public function setCoordY($coordY) {$this->coordY = $coordY;}
	public function setPrice($price) {$this->price = $price;}
}

class Row {
	//	PROPERTIES
	private $id;
	private $seats = array();

	//	CONSTRUCTOR
	function __construct($id = null) {
		$this->id = $id;
	}

	//	GETTERS
	public function getId() {return $this->id;}
	public function getSeats() {return $this->seats;}

	//	SETTERS
	public function setId($id) {$this->id = intval($id);}
	public function setSeats($seats) {$this->seats = $seats;}

	//	METHODS
	public function addSeat($seatId = null, $seatNumber = null, $coordX = null, $coordY = null, $price = 0) {
		$this->seats[] = new Seat($seatId, $seatNumber, $coordX, $coordY, $price);
	}
}

class Section {
	//	PROPERTIES
	private $id;
	private $rows = array();

	//	CONSTRUCTOR
	function __construct($id = null) {
		$this->id = $id;
	}

	//	GETTERS
	public function getId() {return $this->id;}
	public function getRows() {return $this->rows;}
	public function getRow($rowId) {return $this->rows[$rowId];}

	//	SETTERS
	public function setId($id) {$this->id = intval($id);}
	public function setRows($rows) {$this->rows = $rows;}

	//	METHODS
	public function addRowIfNeeded($rowId) {
		$found = false;
		foreach($this->rows as $r) {
			if($r->getId() === $rowId) {
				$found = true;
				break;
			}
		}
		if(!$found) {
			$this->rows[$rowId] = new Row($rowId);
		}
	}
}

//	Just for show survey
class SurveyShow {
	//	PROPERTIES
	protected $id;
	protected $title;
	protected $score = 0;

	//	CONSTRUCTOR (to be run at instantiation time)
	function __construct($new_id, $new_title) {	//	must set properties at time of instantiation
		$this->id = $new_id;
		$this->title = $new_title;
	}

	//	GETTERS
	public function get_id() {
		return $this->id;
	}
	public function get_score() {
		return $this->score;
	}
	public function get_title() {
		return $this->title;
	}

	//	SETTERS
	public function set_score($new_score) {
		$this->score = $new_score;
	}
}
?>
