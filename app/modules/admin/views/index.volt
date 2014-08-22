<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My awesom site">
    {% block title %}
        {{ get_title() }}
    {% endblock %}
    {% block stylesheets %}
        {{ stylesheet_link("http://yui.yahooapis.com/pure/0.5.0/pure-min.css", false) }}
        {{ stylesheet_link("assets/css/layouts/side-menu.css") }}
    {% endblock %}
    {% block javascripts %}
        {{ javascript_include("http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js", false) }}
        {{ javascript_include("assets/js/ui.js") }}
    {% endblock %}
</head>
<body>
    <div id="layout">
        <!-- Menu toggle -->
        <a href="#menu" id="menuLink" class="menu-link">
            <!-- Hamburger icon -->
            <span></span>
        </a>
        <div id="menu">
            <div class="pure-menu pure-menu-open">
                {{ link_to('admin', 'Admin Top', 'class':'pure-menu-heading') }}
                <ul>
                    <li>{{ link_to('', 'Show Site') }}</li>
                </ul>
            </div>
        </div>
        <div id="main">
            {{ content() }}
        </div>
    </div>
</body>
</html>

