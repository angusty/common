//添加评论到 CommentList
var CommentList = React.createClass({
    render : function() {
        return (
            <div className="commentList">
                <Comment author="博洋">第一条评论</Comment>
                <Comment author="小云">第二条评论</Comment>
            </div>
        );
    }
});


var CommentForm = React.createClass({
    render : function () {
        return (
            <div className="commentForm">
                Hello, world! I am a CommentForm.
            </div>
        );
    }
});
