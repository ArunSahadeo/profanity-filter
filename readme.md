## Profanity Filter

This is a Composer package I have written to learn more about TDD (test-driven development).

How-to use:

```php
<?php

require "vendor/autoload.php";

$profanityFilter = new ArunSahadeo\ProfanityFilter();

$text = "Hello *profanity";

$text = $profanityFilter->censorProfanities($text);

echo $text;
?>
```
