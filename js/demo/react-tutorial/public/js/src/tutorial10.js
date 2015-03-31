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



