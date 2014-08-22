<h2 class="content-subhead">Menu</h2>

<p>{{ t._('hello') }}</p>

<ul>
    <li>{{ link_to('dummy/json', 'Json output test') }}</li>
    <li>{{ link_to('dummy/cache', 'Cache test') }}</li>
    <li>{{ link_to('dummy/session', 'Session test') }}</li>
    <li>{{ link_to('dummy/upload', 'Upload test') }}</li>
    <li>{{ link_to('dummy/find', 'Find test') }}</li>
    <li>{{ link_to('dummy/update', 'Update test') }}</li>
    <li>{{ link_to('dummy/log', 'Log test') }}</li>
    <li>{{ link_to('dummy/mail', 'Mail test') }}</li>
    <li>{{ link_to('dummy/signup', 'Sign Up test') }}</li>
    <li><a href="{{ secureUrl }}">Secure Url Test</a></li>
</ul>