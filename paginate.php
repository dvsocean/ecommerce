<?php 
class Paginate{

public $current_page;
public $items_per_page;
public $total_items;

	public function __construct($page, $items_per_page, $total_items){
		$this->current_page= $page;
		$this->items_per_page= $items_per_page;
		$this->total_items= $total_items;
	}


	public function next(){
		return $this->current_page + 1;
	}


	public function previous(){
		return $this->current_page -1;
	}


	public function total_pages(){
		return ceil($this->total_items / $this->items_per_page);
	}


	public function has_previous(){
		return $this->previous() >= 1 ? true : false; 
	}


	public function has_next(){
		return $this->next() <= $this->total_pages() ? true : false; 
	}

	public function offset(){
		return ($this->current_page - 1) * $this->items_per_page;
	}

}//End of class



?>

