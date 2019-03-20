<?php
/*
========SystemTheme========
(c) 2018-2019 MelEnd-Studio
+++++++++++++++++++++++++++
Dernière MAJ le: 19-03-2019
===========================
Fichier: system_template.php
Version: 1.0
*/

class template {
	private $template;
	private $directory;
	private $property;
	private $assignVarID;
	private $assignVarValue;

	function __construct($folder, $name) {
		$this->template = $name;
		$this->root_directory = $_SERVER['DOCUMENT_ROOT']."/$folder";
		$this->directory = "/$folder";
		$this->property = json_decode(file_get_contents($this->root_directory.$this->template.'/require.json'), true);
		$this->assignVarID = array();
		$this->assignVarValue = array();
		$this->checkIntegrity($this->template);
	}

	function get_property() {
		$property_table = $this->property;
		$table = array(
			'author_name' => $property_table['author']['name'],
			'author_email' => $property_table['author']['e-mail'],
			'author_site' => $property_table['author']['site'],
			'theme_name' => $property_table['theme']['name'],
			'theme_update' => $property_table['theme']['update'],
			'theme_version' => $property_table['theme']['version']
		);
		return($table);
	}

	function set_var($ID, $value) {
		$ID = $this->encodeVar($ID);
		array_push($this->assignVarID, $ID);
		array_push($this->assignVarValue, $value);
	}

	function set_template($name) {
		$this->template = $name;
		$this->checkIntegrity($this->template);
	}

	function set_directory($folder) {
		$this->directory = $folder;
		$this->root_directory = $_SERVER['DOCUMENT_ROOT']."/$folder";
		$this->checkIntegrity($this->template);
	}

	function clear_var() {
		$this->assignVarID = array();
		$this->assignVarValue = array();
	}

	function load_page($page, $include = false) {
		if($include) {
			$contents = $this->getPage("header", $include)."\n".$this->getPage($page, $include)."\n".$this->getPage("footer", $include);
		}
		else {
			$contents = $this->getPage($page, $include);
		}
		echo $this->replaceVar($contents);
	}

	function encodeVar($var) {
		return "{".$var."}";
	}

	function getPage($name, $include = false) {
		$property_table = $this->property;
		if(($name == "header" OR $name == "footer") AND $include == true) {
			$file_link = $property_table['template']['includes'][$name];
			$file = file_get_contents($this->root_directory.$this->template.'/'.$file_link);
			return $file;
		}
		else {
			$file_link = $property_table['template']['pages'][$name];
			$file = file_get_contents($this->root_directory.$this->template.'/'.$file_link);
			return $file;
		}
	}

	function replaceVar($file) {
		$file = str_replace($this->assignVarID, $this->assignVarValue, $file);
		$file = str_replace("[TPL-ROOT]", $this->directory.$this->template, $file);
		return $file;
	}

	function checkIntegrity($theme){
		$erreur = array();
		if(!file_exists($this->root_directory)) {
			$erreur['directory']['root_directory'] = "Directory Error, check: ".$this->root_directory;
		}
		if(!file_exists($this->root_directory.$theme)) {
			$erreur['directory']['template_directory'] = "Directory Error, check: ".$this->root_directory.$theme;
		}
		if(!file_exists($this->root_directory.$theme.'/require.json')) {
			$erreur['require_file'] = "Require file Error, check if require file exist at: ".$this->root_directory.$theme.'/require.json';
		}
		if(count($erreur) > 0) {
			var_dump($erreur);
		}
	}
}
