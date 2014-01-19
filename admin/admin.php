<?php
class admin{

private $element = array();
private $page_title = "";

public function set_title($title){
	return $this->page_title = $title;
}
public function get_title(){
	return $this->page_title;
}

	public function add_dashboard_element($element, $heading = '', $functionname = '', $row, $position, $help = array(0 => array("id" => 0, "title" => '', "content" => ''))){
		$this->element[$element] = array(
			'Heading' => $heading,
			'functionname' => $functionname,
			'row' => $row,
			'position' => $position,
			'help' => $help
		);
	}

	public function get_dashboard_elements($row, $html = true){
		$output = array();
		foreach($this->element as $name => $element){
			if($row == $element["row"]){
				if($html){
				?>
				<div class='element' id='<?php echo $name; ?>'>
					<div class='element-heading'><span><?php echo $element["Heading"]; ?></span></div>
					<div class='element-content'>
						<?php call_user_func_array($element["functionname"], array("target" => "dashboard")); ?>
					</div>
					</div>
				<?php
				}else{
					$output[] = $this->element[$name];
				}
			}
		}
		return $output;
	}

	public function get_help($html = true){
		$output = array();
		foreach($this->element as $name => $element){
				if($html){
				
				echo "<div class='help_box' id='help-$name'>";
				foreach($element["help"] as $help){
				if($help != ""){
				?>
					<div class="help_element" id="help-<?php echo $help["id"]; ?>">
					<div class="help_element_title"><?php echo $help["title"]; ?></div>
					<div class="help_element_content"><?php echo $help["content"]; ?></div>
					</div>
				<?php
				}
				}
				echo "</div>";
				}else{
					$output[$name] = $this->element[$name]['help'];
				}
			}
		return $output;
	}

	public function metabox(){

		if(check_if_outdated()){
		?>
		<div class="element danger" style="width: 100%;">
			<div class="element-heading">
				<span><?php echo _t("browser issue"); ?></span>
			</div>
			<div class="element-content">
				<?php echo _t("you are using a outdated browser. Outdated browsers may have security issues! Please update your browser or install a new one"); ?>
			</div>
		</div>
		<?php
		}
	}
}
?>