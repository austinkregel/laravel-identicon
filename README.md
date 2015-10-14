# What is it?
This is a Laravel wrapper for the [identicon package](https://github.com/yzalis/identicon) written by [yzalis](https://github.com/yzalis). This package comes equipped a custom 
identicons named route for easy profile image redering. The custom route can be accessed using a named route or by going to 
`http://YOURDOMAIN.TLD/identicon/d/STRING` where the string is whatever you want...
```php
route('identicon::main', [
    'YOUR STRING HERE', 
    'SIZE (optional)', 
    'TEXT_COLOR (optional)', 
    'BACKGROUND_COLOR (optional)'
]);
```

# How to set up.
  1.  `composer require kregel/identicon`
      or add `"kregel/identicon":"dev-master"` to your composer.json file, just be sure to use `composer update` with that statement, or if you haven't build your dependancies use `composer install` instead.
      
      
  2.  Register the service provider with your `config/app.php` file
  
  ```php
  'providers' => [
    ...,
    Kregel\Identicon\IdenticonServiceProvider::class,
    ...,
  ]
  ```
  3.  Add the alias to your `config/app.php` file
  
  ```php
  'aliases' => [
    ...,
    'Identicon' => Kregel\Identicon\Facades\Identicon::class,
    ...,
  ]
  ```
## Use it!
  I use this method (similar to Gravatar)
  ```php
  <img src="{{ route('identicon::main', [
    md5($user->email), 
    '200' 
]) }}">
  ```

# Questions?
Email me (my email is on [my github page](http://github.com/austinkregel)), or you can drop an issue. :)
