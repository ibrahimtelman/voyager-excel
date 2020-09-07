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
  //or with closure ["key1" => [ "name" => "New Name", "value" => function($value){ return $value } ]]
  //you all free to combine three options
  
  //example
  return array(
    "id", "fullname" => [
          "name" => "Name",
          "value" => function ($value) {
              return strtoupper($value);
          }
      ], "email" => "Email", "phone" => "Phone"
  );
}
```

## Support Language

- tr
- zh_CN （中文）
- en 

## License

MIT

## Links

- [Voyager中文文档](http://doc.laravel-voyager.cn/)
- [国内插件源](http://satisfy.xiaoqiezi.top)
- [国内插件源使用方法](http://doc.laravel-voyager.cn/getting-started/installation.html#%E5%AE%89%E8%A3%85%E4%B8%AD%E6%96%87%E8%AF%AD%E8%A8%80%E5%8C%85)
