/**
 * URL相关js
 */

<script type="text/javascript">

    /**
     * 实现将搜索框的关键字附加于url末尾，通过URL的GET方式传递(用于非?name=a&b=c的方式传递)
     * 比如： url ： http://localhost.com/demo/test.php
     *
     * 使用例子：
     * var url = window.location.href,
     *     key_words = '名人';
     * new_url = addVariableToURL(url, 'key_words_search', key_words, '/', '.html');
     *
     * @author  yangbo
     * @date    2014-12-15
     * @param   string  url  完整的url字符串
     * @param   string  key_words_name  要传递的搜索的名称
     * @param   string  key_words_value  搜索的具体值
     * @param   string  separator  url变量间实际分隔符  eg. '/','-'
     * @param   string  url_subffix  url后缀, eg.  '.html','.php','.jsp'
     * @return string url 返回URL
     */
    function addVariableToURL(url, key_words_name, key_words_value, separator, url_subffix)
    {
        separator = separator === undefined ? '/' : separator;
        url_subffix = url_subffix === undefined ? '' : url_subffix;
        var url_prefix = url.indexOf('https') === -1 ? 'http' : 'https';
        url_prefix = url_prefix + '://';
        url = url.replace(url_prefix, '');
        var url_html_position = url.indexOf(url_subffix),
            has_html_subffix = false;
            console.log(url_html_position);
            if (url_html_position !==-1) {
                url = url.substr(0, url_html_position);
                has_html_subffix = true;
            }
            var url_array = url.split(separator);
            var new_url_array = [];
            for (var i in url_array) {
                var key = url_array[i-1];
                if(key === undefined) {
                    key = 'domain';
                }
                new_url_array[key] = url_array[i];
            }
            //处理url 如果不存在这个值 则直接追加在原url上 存在 则 修改其值
            if (new_url_array[key_words_name] === undefined) {
                url = url + separator + key_words_name + separator + key_words_value;
            } else {
                new_url_array[key_words_name] = key_words_value;
                var new_url = '';
                for (var i in new_url_array) {
                    new_url += new_url_array[i] + separator;
                }

                //var pattern = eval("/\[\\"+separator+"]/");
                //正则表达式里使用变量  用RegExp对象方式
                var pattern = RegExp(separator+'$');

                url = new_url.replace(pattern, '');
            }
            //组装url前缀
            url = url_prefix + url;
            if (has_html_subffix === true) {
                url = url + url_subffix;
            }
            return url;
    }

</script>
