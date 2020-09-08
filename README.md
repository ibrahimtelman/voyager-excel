# Voyager Excel Export

a plugin for excel export

## Install hook

```bash
php artisan hook:install voyager-excel-export
```

## Enable hook

```bash
php artisan hook:enable voyager-excel-export
```

## Usage

### Add traits to model

```php
use ExcelExport;

```

### Add setter method to model

```php
public function setExportable()
{
  //list column of table which you want to export
  //type 1 ["key1", "key2"]
  //type 2 ["key1" => "New Name", "key2" => "New Name"]
  //or with closure ["key1" => [ "name" => "New Name", "value" => function($value, $model){ return $value } ]]
  //you all free to combine three options

  //example
  return array(
    "id", "fullname" => [
          "name" => "Name",
          "value" => function ($value, $model) {
              return strtoupper($value);
          }
      ], "email" => "Email", "phone" => "Phone"
  );
}
```

## Support Language

- tr
- en
- zh_CN （中文）

## License

MIT

## Links

- [Voyager](https://voyager-docs.devdojo.com/)
