lib-wp-post-status
================

## Description
Wordpress Post Status library for managing custom post statuses and assigning them to specific post types.

##Examples
```php

/**
 * Add custom post status 'Inactive' for 'post' and 'page' post types.
 * 
 * Note: it must be called before or on 'init' action hook.
 * Note: all other arguments are equal to register_post_status() function 
 * See: https://codex.wordpress.org/Function_Reference/register_post_status
 */
\UsabilityDynamics\CPS\Manager::set( array(
  'id' => 'inactive',
  'label' => 'Inactive',
  'post_types' => array( 'post', 'pages' )
) );

```

## License

(The MIT License)

Copyright (c) 2013 Usability Dynamics, Inc. &lt;info@usabilitydynamics.com&gt;

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.