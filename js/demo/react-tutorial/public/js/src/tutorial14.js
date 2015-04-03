var CommentBox = React.createClass({
    getInitialState : function() {
        //this.setState({data: {"author": "Mr one", "text": "第一条评论"}});
        //return null;
        return {data: []};
    },
    loadCommentsFromServer : function() {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            async: true,
            success: function(data) {
                this.setState({data: data});
                //this.props.data = data;
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    componentDidMount: function() {
        this.loadCommentsFromServer();
        setInterval(this.loadCommentsFromServer, this.props.pollInterval);
    },
    render: function() {
        return (
            <div className="commentBox">
                <h1>Comments</h1>
                <CommentList data={this.state.data} />
                <CommentForm />
            </div>
        );
    }
});

var data = [
    {"author": "Mr one", "text": "第一条评论"},
    {"author": "Mr two", "text": "第二条评论"},
    {"author": "Mr three", "text": "第三条评论"},
    {"author": "Mr four", "text": "第五条评论"},
    {"author": "Mr six", "text": "第六条评论"}
];

React.render(<CommentBox url="./json/comments.json" pollInterval="3000"/>, document.getElementById('content'));
