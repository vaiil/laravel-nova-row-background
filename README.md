# Laravel Nova field to set background for resource rows
Set background color to resource row and auto choose white or black text color.  

## Usage
Add to your resource file: 
```php
use Upline\RowBackground\RowBackground;
```
and field to fields section
```php
RowBackground::make('Background color')->onlyOnIndex();
```
or (to set text color)
```php
 RowBackground::make('Background color', function ($model) {
    return new RowBackgroundData($model->background_color, $model->text_color);
})->onlyOnIndex();
```

**Note:**  
This package works pretty tricky:  
It deletes a column that nova adds to index view.  
If you know better ways to set row styles, please write me.
