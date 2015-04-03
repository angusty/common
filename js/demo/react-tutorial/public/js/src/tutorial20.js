var CommentBox = React.createClass({
    getInitialState: function() {
        return {data: []};
    },
    loadCommentsFromServer: function() {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }
        });
    },
    handleSubmit: function(comment) {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            data: comment,
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    componentDidMount: function() {
        this.loadCommentsFromServer;
        setInterval(this.loadCommentsFromServer, this.props.pollInterval)
    },
    render: function() {
        return (
            <div className="commentBox">
                <CommentList data={this.state.data} />
                <CommentForm onCommentSubmit={this.handleSubmit} />
            </div>
        );
    }
});

React.render(<CommentBox url="./json/comments.json" pollInterval="4000" /> , document.getElementById('content'));
