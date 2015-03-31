var CommentForm = React.createClass({
    render : function() {
        return (
            <form className="commentForm" >
                <input type="text" placeholder="请输入名字" />
                <input type="text" placeholder="发表你的获奖感言" />
                <input type="submit" value="提交" />
            </form>
        );
    }
});
