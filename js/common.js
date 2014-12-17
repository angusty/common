/**
 * 通用方法
 */
<script type="text/javascript">

    //重写js的trim()方法  调用方法，对象方式，
    String.prototype.trim = function() {
        var str = this,
        whitespace = ' \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000';
        for (var i = 0,len = str.length; i < len; i++) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(i);
                break;
            }
        }
        for (i = str.length - 1; i >= 0; i--) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);
            break;
            }
        }
        return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
    }

    //另一个 重写js的trim()的方法，javascript1.8.1才支持trim函数，适用于之前版本的javascript
    String.prototype.trim = function() {
        var str = this,
        str = str.replace(/^\s+/, '');
        for (var i = str.length - 1; i >= 0; i--) {
            if (/\S/.test(str.charAt(i))) {
            str = str.substring(0, i + 1);
            break;
            }
        }
        return str;
    }
</script>
