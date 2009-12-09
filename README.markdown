NeoAll - the Neopets RSS Aggregator
===================================

Heya,

Still working on my first prototype. Look but don't touch - I'll open
development to the public very soon, I promise :)

Some basic things to understand:

  * written in PHP
  * the web root is in `/www/` - project files not in there are private
  * Dependencies (you should have a lot already):
    - Apache (.htaccess files)
    - PHP 5
    - PHP CLI (for running files in `/scripts/`)
    - MDB2 Pear module
    - [SimplePie Requirements][sreq]
      - Required: XML, PCRE extensions (installed by default)
      - Preferred: mbstring, iconv, cURL, Zlib extensions
      
Have fun poking around!

On first run:

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


[sreq]: http://simplepie.org/wiki/setup/requirements
