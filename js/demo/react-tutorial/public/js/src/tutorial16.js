var CommentForm = React.createClass({
    handleSubmit: function(e) {
        e.preventDefault();
        var author = this.refs.author.getDOMNode().value.trim(),
            text = this.refs.text.getDOMNode().value.trim();
            if(!text || !author) {
                //console.log(名字和内容都不能为空);
                return ;
            }

            //TODO: send request to the server


            //清楚填表数据
            this.refs.author.getDOMNode().value = '';
            this.refs.text.getDOMNode().value = '';
    },
    render : function() {
        return (
            <form className="commentForm"  onSubmit={this.handleSubmit} >
                <input type="text" placeholder="请输入你的名字" ref="author" />
                <input type="text" placeholder="请发表获奖感言" ref="text" />
                <input type="submit" text="提交" name="submit" />
            </form>
        );
    }
});
