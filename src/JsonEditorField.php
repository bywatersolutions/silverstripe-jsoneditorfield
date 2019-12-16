<?php

namespace ByWaterSolutions\JsonEditorField;

// use stuff here
use SilverStripe\Forms\TextField;
use SilverStripe\View\Requirements;

class JsonEditorField extends TextField {


  /**
   * @desc JsonField constructor.
   * @param $name
   * @param null $title
   * @param string $value
   * @param null $form
   * @param null $schema
   */
  public function __construct($name, $title = null, $value = '{}', $form = null, $schema = '{}')
  {
    if (!$value) {
	$value = '{}';
    };
    if (!$schema) {
	$schema = '{}';
    };
    parent::__construct($name, $title, $value, '', $form);
    Requirements::javascript('bywatersolutions/silverstripe-jsoneditorfield:client/javascript/JsonEditorField.js');
    Requirements::javascript('bywatersolutions/silverstripe-jsoneditorfield:client/javascript/lib/jsoneditor.min.js');
    Requirements::javascript('bywatersolutions/silverstripe-jsoneditorfield:client/javascript/silverstripe.js');
    Requirements::css('bywatersolutions/silverstripe-jsoneditorfield:client/styles/jsoneditorfield.css');
    $this->addExtraClass('jsoneditorfield');
    $this->setInputType('hidden');
    $this->setAttribute('data-field-schema', $schema);

  }

}

