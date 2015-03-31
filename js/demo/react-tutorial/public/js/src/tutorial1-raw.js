var CommentBox = React.createClass({
    render : function () {
        return (
            React.createElement('div', {className: "commentBox"}, "你好, 我是CommentBox组件")
        );
    }
});

// React.render(<CommentBox />, document.getElementById('content'));    // 可以运行
React.render(React.createElement(CommentBox, null), document.getElementById('content'));
