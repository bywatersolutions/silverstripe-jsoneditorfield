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
    Requirements::javascript('app/jsonfield/javascript/JsonEditorField.js');
    Requirements::javascript('app/jsonfield/javascript/lib/jsoneditor.min.js');
    Requirements::javascript('app/jsonfield/javascript/silverstripe.js');
    Requirements::css('app/jsonfield/styles/jsoneditorfield.css');
    $this->addExtraClass('jsoneditorfield');
    $this->setInputType('hidden');

    Requirements::customScript(<<<JS
	function initJsonField() {
	      var startval = JSON.parse(document.getElementById('Form_ItemEditForm_$name').value);

	      // Initialize the editor
	      var editor = new JSONEditor(document.getElementById('Form_ItemEditForm_$name' + '_Editor'),{
	        ajax: true,
	        schema: $schema,
		startval: startval,
		// Disable JSON editing
		//disable_edit_json: true,
		disable_collapse: true,
//                display_required_only: true,
                required_by_default: true,
	        no_additional_properties: true,
	       // Require all properties by default
	       //required_by_default: true,
		theme: "silverstripe"
   	      });

      // Hook up the validation indicator to update its 
      // status whenever the editor changes
      editor.on('change',function() {
        // Get an array of errors from the validator
        var errors = editor.validate();
        var indicator = document.getElementById('valid_indicator');
	var save_button = document.getElementById('Form_ItemEditForm_action_save');
	var save_button2 = document.getElementById('Form_ItemEditForm_action_doSaveAndQuit');
        // Not valid
        if(errors.length) {
          indicator.style.color = 'red';
          indicator.textContent = "not valid";
	  save_button.disabled = true;
	  save_button2.disabled = true;
          save_button.title = "JSON not valid; see console for details";
          save_button2.title = "JSON not valid; see console for details";
          console.log(errors);
        }
        // Valid
        else {
          indicator.style.color = 'green';
          indicator.textContent = "valid";
	  save_button.disabled = false;
	  save_button2.disabled = false;
          save_button.title = '';
          save_button2.title = '';
          var input = document.getElementById('Form_ItemEditForm_$name');
          input.value = JSON.stringify(editor.getValue());
        }
      });
	}

JS
    );
  }

}

