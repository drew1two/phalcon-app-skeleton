<h2 class="content-subhead">Upload Test</h2>

{% if result is empty %}
    {{ form('dummy/upload', 'id': 'form1', 'method': 'POST', 'enctype': 'multipart/form-data') }}
        <label>Select Files:</label> <br>
        {{ file_field('file1') }} <br>
        {{ file_field('file2') }} <br>
        {{ submit_button('送信') }} <br>
    </form>
{% else %}
    {{ result }}
{% endif %}