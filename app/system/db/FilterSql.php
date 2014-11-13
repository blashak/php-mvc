<?php

class FilterSql {
	
	private $filter = array();
	private $where;
	private $orderBy;
	private $groupBy;
	private $limit;
	
	public function __construct(array $filter = null) {
		$this->filter = $filter;
		
		if(isset($this->filter)) {
			foreach($this->filter as $k => $v) {
				if(substr_count($k, 'limit')) {
					$this->addLimit($this->filter['limit']);
				}
				elseif(substr_count($k, 'where')) {
					
					$split = explode('!=', $this->filter[$k]);
					
					if(isset($split) && count($split) == 2) {
						$split[1] = trim($split[1]);
						$this->filter[$k] = $split[0]." != '$split[1]'";
					}
					else {
					
						$split = explode('=', $this->filter[$k]);
						
						if(isset($split) && count($split) == 2)
						{
							$split[1] = trim($split[1]);
							$this->filter[$k] = $split[0]." = '$split[1]'";
						}
						elseif(isset($split) && count($split) == 3) // Este caso es para el password hash que en el valor contiene un =
						{
							$split[1] = trim($split[1]);
							$this->filter[$k] = $split[0]." = '$split[1]=$split[2]'";
						}
						else
						{
							$split = explode('like', $this->filter[$k]);
							
							if(isset($split) && count($split) == 2)
							{
								$split[1] = trim($split[1]);
								$this->filter[$k] = $split[0]." like '$split[1]'";
							}
							
						}
					}
					
					$this->addWhere($this->filter[$k]);
					
				}
				elseif(substr_count($k, 'defWhere')) {
					$this->addWhere($this->filter[$k]);
				}
				elseif(substr_count($k, 'orderBy')) {
					$this->addOrderBy($this->filter[$k]);
				}
				elseif(substr_count($k, 'groupBy')) {
					$this->addGroupBy($this->filter[$k]);
				}
			}
		}
		
	}
	
	private function addWhere($where) {
		if($this->where == '') {
			$this->where = 'WHERE '.$where;
		}
		else {
			$this->where .= ' AND '.$where;
		}
	}
	
	private function addOrderBy($orderBy) {
		if($this->orderBy == '') {
			$this->orderBy = ' ORDER BY '.$orderBy;
		}
		else {
			$this->orderBy = ','.$orderBy;
		}
	}
	
	private function addGroupBy($groupBy) {
		if($this->groupBy == '') {
			$this->groupBy = ' GROUP BY '.$groupBy;
		}
		else {
			$this->groupBy = ','.$groupBy;
		}
	}
	
	private function addLimit($limit) {
		$this->limit = ' LIMIT '.$limit;
	}
	
	public function __toString() {
		$query =
			$this->where.
			$this->groupBy.
			$this->orderBy.
			$this->limit
		;
		
		return (string) $query;
	}
}