//更新 CommentBox组件 使用新组件
var CommentBox = React.createClass({
    render : function() {
        return (
            <div>
                <h1>Comment</h1>
                <CommentList />
                <CommentForm />
            </div>
        );
    }
});

React.render(<CommentBox />, document.getElementById('content'));
