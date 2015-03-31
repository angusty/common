// React.render(
//     <CommentBox url="../json/comments.json"/> ,
//     document.getElementById('content')
// );
var data = [
    {"author": "Mr one", "text": "第一条评论"},
    {"author": "Mr two", "text": "第二条评论"},
    {"author": "Mr three", "text": "第三条评论"},
    {"author": "Mr four", "text": "第五条评论"},
    {"author": "Mr six", "text": "第六条评论"}
];
React.render(<CommentBox data={data} />, document.getElementById('content'));
// React.render(<CommentBox url="./json/comments.json" />, document.getElementById('content'));
