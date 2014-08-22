<h2 class="content-subhead">User Sign Up</h2>

{{ form('dummy/signup', 'id': 'form1', 'method': 'POST') }}
    {#{ hidden_field('device_type', 'value':0) }#}
    <label>name: </label>{{ text_field('user_name') }} <br>
    <label>email: </label>{{ text_field('user_email') }} <br>
    <label>password: </label>{{ password_field('password') }} <br>
    {{ submit_button('送信') }} <br>
</form>
