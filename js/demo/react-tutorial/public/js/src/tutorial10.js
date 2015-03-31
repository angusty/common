var CommentList = React.createClass({
    render : function() {
            var commentNodes = '';
            if (this.props.data !== undefined) {
                commentNodes = this.props.data.map(function(comment) {
                    return (
                        <Comment author={comment.author} >
                            {comment.text}
                        </Comment>
                    );
                });
            }

            return (
                <div className="commentList">
                    {commentNodes}
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

