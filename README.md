# Contao - Propstack API
This extension serves as a bridge between Contao and the Propstack API.

- Access to the API can be protected
- API calls can be made both via GET (protected) and directly via PHP (unprotected)
- In-build parameter checking: only allowed parameters are passed to the API to prevent errors

**Example (GET):**
```
http://contao413.local/api/propstack/units?key=contao_api_key
```

**Example (PHP):**
```
$objUnits = new UnitController();
$objUnits->setFormat(PropstackController::FORMAT_JSON);

$units = $objUnits->read($parameters);
$units = $objUnits->readOne($id);
$units = $objUnits->edit($id, $parameters);
$units = $objUnits->create($parameters);
$units = $objUnits->delete($id);
```
