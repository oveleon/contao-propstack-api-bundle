# Contao - Propstack API (v1)

> [!IMPORTANT]
> Open source development of this plugin has been abandoned.
> Further development continues might continue in private and is no longer publicly available.
>
> **Version 2 for Propstack API**
> See https://api.propstack.de/docs for more information

This extension serves as a bridge between Contao and the Propstack API. You can find the documentation for Propstack [here](https://docs.propstack.de/). A Propstack API key is required for use.

- Access to the API can be protected
- API calls can be made both via GET (protected) and directly via PHP (unprotected)
- In-build parameter checking: only allowed parameters are passed to the API to prevent errors

**Endpoints:**\
All currently available endpoints can be viewed [here](https://github.com/oveleon/contao-propstack-api-bundle/tree/main/src/Controller).

**Example (GET):**
```
https://example.com/api/propstack/units?key=contao_api_key

// Show all routes
https://example.com/api/propstack/help?key=contao_api_key
```

**Example (PHP):**
```php
$objUnits = new UnitController();
$objUnits->setFormat(PropstackController::FORMAT_JSON);

$units = $objUnits->read($parameters);
$units = $objUnits->readOne($id);
$units = $objUnits->edit($id, $parameters);
$units = $objUnits->create($parameters);
$units = $objUnits->delete($id);

// Create a unit with custom fields
$objUnits->setCustomFields(['my_custom_field']);

$units = $objUnits->create([
    'title'          => 'My Unit',
    'marketing_type' => 'BUY',
    'object_type'    => 'LIVING',
    'rs_type'        => 'APARTMENT',
    'custom_fields'  => [
        'my_custom_field' => '123'
    ]
]);
```

