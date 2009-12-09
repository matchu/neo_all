NeoAll - the Neopets News Aggregator
===================================

[Check it out live!][neoall]

Things to know:
---------------

  * written in PHP
  * the web root is in `/www/` - project files not in there are private
  * Dependencies (you should have a lot already):
    - Apache (.htaccess files)
    - PHP 5
    - PHP CLI (for running files in `/scripts/`)
    - MDB2 Pear module
    - [SimplePie Requirements][simplepie-req]
      - Required: XML, PCRE extensions (installed by default)
      - Preferred: mbstring, iconv, cURL, Zlib extensions
      
Have fun poking around!

On first run:
-------------

  * Enter your database info in `config/db_config.php`
    (see `config/db_config.sample.php` for proper formatting)
  * Run
        $ scripts/load_sources.php
    to load the RSS feeds (you may want to put this on cron later)
  * Run
        $ migrations/main.php db:setup
        $ migrations/main.php db:version
        $ migrations/main.php db:migrate
    to get your database up-to-speed
  * Point Apache to `/www/` as the web root (NOT the root project folder!)
  * Pull it up and see if it worked! :)
  
Want to contribute?
-------------------

The door's wide open. **You** can help if you are experienced in *any* of the
following:

* PHP - work the back-end with [OOP][php-oop] awesomeness!
* Javascript - bring us some wonderful front-end functionality!
* CSS - make things look pretty!

Contributing to open-source projects is an excellent way to get some good
practice in - and, if making websites is what excites you, it should be good
fun!

Just [learn the basics of Git][learn-git], make your own fork of this project, and start
whittling away. Send in a pull request to 'matchu' when you think your code
is ready.

Thanks so much!


[neoall]: http://neoall.neo-portal.net/
[simplepie-req]: http://simplepie.org/wiki/setup/requirements
[php-oop]: http://us3.php.net/oop
[learn-git]: http://learn.github.com/
