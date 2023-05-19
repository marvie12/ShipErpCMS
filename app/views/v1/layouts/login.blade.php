<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('web.title') }}</title>
    <link rel="stylesheet" href="{{ url() }}/stylesheets/app.css" />
    <script src="{{ url() }}/bower_components/modernizr/modernizr.js"></script>
  </head>
  <body>
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">{{ config::get('web.app.display_name') }}</a></h1>
        </li>
      </ul>
    </nav>

    @yield('body')

    <script src="{{ url() }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ url() }}/bower_components/foundation/js/foundation.min.js"></script>
    <script src="{{ url() }}/js/app.js"></script>
    <script type="text/javascript">
      <?php
        $domain = getenv('WEBSITE_DOMAIN');
        $domainArr = explode('.', $domain);
        array_shift($domainArr);
        $domain = implode('.', $domainArr);

        ?>
    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";


        var cookieName = name+"="+value+expires+"; domain=.{{ $domain }}; path=/";
        document.cookie = cookieName;
    }
</script>
  </body>
</html>
