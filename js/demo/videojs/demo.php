<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>video demo</title>
    <link rel="stylesheet" type="text/css" href="video-js/video-js.css">
        <script type="text/javascript" src="video-js/video-dev.js"></script>
<!--     <script type="text/javascript" src="video-js/video.js"></script> -->
 <!--    <script type="text/javascript" src="video-js/video.dev.js"></script> -->
</head>
<body>
  <!--
    controls：是否显示控制面板
　　autoplay：是否自动播放
　　preload：视频是否预加载
　　poster：当前视频数据无效时显示（预览图）
  -->

    <div>
        <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
          controls preload="auto" width="600" height="400"
          poster= "http://video-js.zencoder.com/oceans-clip.png"
          >
         <!-- <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' /> -->
         <source src="http://www.elitefun.com/uploadfile/2015/0416/20150416040204558.flv" type='video/x-flv'/>
         <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
        </video>
    </div>
    <script type="text/javascript">
      videojs('example_video_1',{
      techOrder : ["html5","flash"],
      children : {
        bigPlayButton : true,    //是否显示大的播放图标
        textTrackDisplay: false,
        posterImage: true,
        errorDisplay : false,
        controlBar : {
            captionsButton : false,
            chaptersButton: false,
            subtitlesButton:false,
            liveDisplay:false,
            playbackRateMenuButton:false
        }
      }
        },function() {
          // this.on('loadeddata',function(){
          //   console.log(this)
          // })

          // this.on('ended',function(){
          // this.pause();
          // //this.hide()
          // })
        });
    </script>
</body>
</html>
