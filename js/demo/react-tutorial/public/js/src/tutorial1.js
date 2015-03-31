var CommentBox = React.createClass({
    render: function() {
        return (
            <div className="commentBox">
                Hello,world! I am a CommentBox.
            </div>
        );
    }
});

//React.render(<CommentBox />, document.getElementById('content'));    //可以运行
React.render(React.createElement(CommentBox, null), document.getElementById('content'));
