//showdown markdown转html的js库
var converter = new Showdown.converter();
//特殊API dangerouslySetInnerHTML,使用此函数React不再处理html标签,不会原样输出标签(默认原样输出标签,React 在保护你免受 XSS 攻击)
var Comment = React.createClass({
    render : function() {
        var rawMarkup = converter.makeHtml(this.props.children.toString());
        return (
            <div className="comment">
                <h2 className="commentAuthor">
                    {this.props.author}
                </h2>
                <span dangerouslySetInnerHTML={{__html: rawMarkup}} />
            </div>
        );
    }
});

