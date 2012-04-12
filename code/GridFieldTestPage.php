<?php
class GridFieldTestPage extends Page {

	static $has_one = array(
		"HasOneCompany" => "Company",
	);

	static $has_many = array(
		"HasManyCompanies" => "Company",
	);

	static $many_many = array(
		"ManyManyCompanies" => "Company",
	);
	
	public function requireDefaultRecords() {
		parent::requireDefaultRecords();
		$page = DataObject::get_one('GridFieldTestPage');
		
		if(!$page) {
			$page = new GridFieldTestPage();
		}
		
		$page->URLSegment = 'gridfieldtest';
		$page->Title = 'GridField Test';
		$page->ParentID = 0;
		$page->write();
		$page->doPublish();
	}

	public function getCMSFields($class = null, $extension = null) {
		$fields = parent::getCMSFields();

		$config = new GridFieldConfig_RecordEditor();
		$grid = new GridField('Companies', 'Companies', new DataList('Company'),$config);
		$fields->addFieldToTab('Root.NoRelation', $grid);

		$config = new GridFieldConfig_RelationEditor();
		$grid = new GridField('HasManyCompanies', 'HasManyCompanies', new DataList('Company'),$config);
		$fields->addFieldToTab('Root.HasMany', $grid);

		$config = new GridFieldConfig_RelationEditor();
		$grid = new GridField('ManyManyCompanies', 'ManyManyCompanies', new DataList('Company'),$config);
		$fields->addFieldToTab('Root.ManyMany', $grid);

		return $fields;
	}
}

class GridFieldTestPage_Controller extends Page_Controller {
	
	/**
	 *
	 * @var string
	 */
	public $Title = "GridFieldTestPage";
	
	public function init(){
		parent::init();
		Requirements::css('frameworktest/css/gridfieldtest.css','screen');
	}
	
	/**
	 *
	 * @return Form 
	 */
	public function Form(){
		$config = new GridFieldConfig_RecordEditor();
		
		$grid = new GridField('Companies', 'Companies', new DataList('Company'),$config);
		return new Form($this,'Form',new FieldList($grid),new FieldList());
	}
}
