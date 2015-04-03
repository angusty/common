var CommentForm = React.createClass({
    handleSubmit: function() {
        e.preventDefault();
        var author = this.refs.author.getDOMNode().value.trim(),
            text = this.refs.text.getDOMNode().value.trim();
            if (!text || !author) {
                return ;
            }
            this.props.onCommentSubmit({author: author, text: text});

            this.refs.author.getDOMNode().value = '';
            this.refs.text.getDOMNode().value = '';
            return ;
    },
    render : function() {
        return (
            <from className="commentForm" onSubmit={this.handleSubmit} >
                <input type="text" placeholder="名字" ref="author" />
                <input type="text" placeholder="评论" ref="text" />
                <input type="submit" value="提交" />
            </from>
        );
    }
});
