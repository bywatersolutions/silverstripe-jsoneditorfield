# silverstripe-jsoneditorfield
Add a JSON Schema-based Editor to SilverStripe.  Uses [JSON Editor](https://github.com/json-editor/json-editor) to build an interactive form for building JSON that's valid according to a provided schema.

# Installation
```
composer require bywatersolutions/silverstripe-jsoneditorfield
```

# Usage

```
use ByWaterSolutions\JsonEditorField\JsonEditorField;

...

private static $db = array[
    'MyJson' => 'Text'
];

public function getCMSFields() {
    $fields = parent::getCMSFields();
    $schema = file_get_contents("path/to/your/schema.json");
    $fields->addFieldToTab("Root.Main", new JsonEditorField("MyJson", "My JSON Document", $this->MyJson, null, $schema));
    return $fields;
}
```
It's that easy!  Of course, you still have to write the JSON Schema and make sure it's valid.... check the console on your browser if you're not getting the form you expected.
